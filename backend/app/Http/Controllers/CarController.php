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

     public function addToCart(Request $request, $id)
    {
        $car = CarfindOrFail($id);

        $cart = session()-get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = [
                name = $car-name,
                price = $car-price,
                quantity = 1,
            ];
        }

        session()-put('cart', $cart);

        return redirect()-route('cart.show')-with('success', 'تمت إضافة السيارة إلى العربة');
    }

    public function showCart()
    {
        $cart = session()-get('cart', []);
        return view('cart.index', compact('cart'));
    }

}
