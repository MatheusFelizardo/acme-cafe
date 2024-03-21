<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\CryptoService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user')->get();
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $token = $request->header('X-Public-Key');
        $crypto = new CryptoService();
        $is_valid = $crypto->validate_key($token, $request->user_id);

        if (!$is_valid) {
            return response()->json(['message' => 'Invalid public key. Please log in and send the valid public key for the user.'], 401);
        }

        $is_valid = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'notes' => 'nullable',
            'status' => 'required|in:pending,paid,cancelled',
            'voucher_id' => 'nullable|exists:vouchers,id',
        ]);

        if (!$is_valid) {
            return response()->json(['message' => 'Invalid data'], 400);
        }

        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $order = Order::with('user')->where('id', $id)->first();
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();
        return response()->json(['message' => 'Order deleted'], 200);
    }
}
