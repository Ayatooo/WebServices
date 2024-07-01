<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function index()
    {
        return CarModel::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);

        return CarModel::create($data);
    }

    public function show(CarModel $carModel)
    {
        return $carModel;
    }

    public function update(Request $request, CarModel $carModel)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);

        $carModel->update($data);

        return $carModel;
    }

    public function destroy(CarModel $carModel)
    {
        $carModel->delete();

        return response()->json();
    }
}
