<?php
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with('user')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_model' => 'required|string',
            'car_type' => 'required|string',
            'pickup_location' => 'required|string',
            'dropoff_location' => 'nullable|string',
            'pickup_time' => 'required|date',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            ...$validated
        ]);

        return response()->json($order, 201);
    }

    public function show(Order $order)
    {
        return $order->load('user');
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->only(['status']));
        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Deleted']);
    }
}