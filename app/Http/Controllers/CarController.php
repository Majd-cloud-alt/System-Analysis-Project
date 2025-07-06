<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function addCar(Request $request)
    {
        $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer|min:1900|max:2100',
        ]);

        $car = Car::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'year'  => $request->year,
        ]);

        return response()->json([
            'message' => 'Car added successfully!',
            'car' => $car
        ]);
    }
}
