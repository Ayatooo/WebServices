<?php

namespace App\Events;

use App\Models\Pixel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PixelUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Pixel $pixel;

    /**
     * Create a new event instance.
     */
    public function __construct(Pixel $pixel)
    {
        $this->pixel = $pixel;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('pixels')
        ];
    }

    public function broadcastToEveryone(): array
    {
        return [
            'x' => $this->pixel->x,
            'y' => $this->pixel->y,
            'color' => $this->pixel->color,
        ];
    }
}
