<?php

namespace App\Http\Controllers;

use App\Models\Pixel;
use Illuminate\Http\Request;

class PixelController extends Controller
{
    public function index()
    {
        return Pixel::all();
    }

    public function update(Request $request)
    {
        $pixel = Pixel::updateOrCreate(
            ['x' => $request->x, 'y' => $request->y],
            ['color' => $request->color]
        );

        return response()->json($pixel, 200);
    }
}
