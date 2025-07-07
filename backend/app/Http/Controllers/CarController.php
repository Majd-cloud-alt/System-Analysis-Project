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
 public function index()
    {
        return response()->json(Car::all(), 200);
    }

    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $validated = $request->validate([
            'model' => 'required|string',
            'year' => 'required' ,
            'brand' => 'required|string',
        ]);

        $car->update($validated);

        return response()->json([
            'message' => 'تم تحديث السيارة بنجاح',
            'car' => $car,
        ], 200);
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return response()->json([
            'message' => 'تم حذف السيارة بنجاح',
        ], 200);
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
