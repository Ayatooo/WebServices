<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Styles -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

</head>
<body>
<div id="app" class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Pixel War</h1>
    <div id="canvas" class="grid grid-cols-100 gap-1"></div>
</div>

<script>
    $(document).ready(function () {
        let canvas = $('#canvas');
        for (let i = 0; i < 100; i++) {
            for (let j = 0; j < 100; j++) {
                canvas.append(`<div id="pixel-${i}-${j}" class="w-4 h-4 border border-gray-200"></div>`);
            }
        }

        $.get('/api/pixels', function (pixels) {
            pixels.forEach(pixel => {
                $(`#pixel-${pixel.x}-${pixel.y}`).css('background-color', pixel.color);
            });
        });

        $('#canvas').on('click', 'div', function () {
            let [_, x, y] = this.id.split('-');
            let color = prompt('Color:');
            if (color) {
                $.post('/api/pixels', {
                    x: x,
                    y: y,
                    color: color,
                    _token: $('meta[name="csrf-token"]').attr('content')
                }, function (pixel) {
                    $(`#pixel-${pixel.x}-${pixel.y}`).css('background-color', pixel.color);
                });
            }
        });
        
        Pusher.logToConsole = true;

        const pusher = new Pusher('9aece9ab9ee6d80b3fff', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('pixels');
        channel.bind('App\\Events\\PixelUpdated', function(e) {
            console.log("event 2", e);
            $(`#pixel-${e.pixel.x}-${e.pixel.y}`).css('background-color', e.pixel.color);

        });
    });
</script>
</body>
</html>
