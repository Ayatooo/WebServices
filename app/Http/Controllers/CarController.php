<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        return Car::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'color' => ['required'],
            'price' => ['required'],
            'car_model_id' => ['required', 'exists:car_models'],
            'user_id' => ['required', 'exists:users'],
        ]);

        return Car::create($data);
    }

    public function show(Car $car)
    {
        return $car;
    }

    public function update(Request $request, Car $car)
    {
        $data = $request->validate([
            'name' => ['required'],
            'color' => ['required'],
            'price' => ['required'],
            'car_model_id' => ['required', 'exists:car_models'],
            'user_id' => ['required', 'exists:users'],
        ]);

        $car->update($data);

        return $car;
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json();
    }
}
