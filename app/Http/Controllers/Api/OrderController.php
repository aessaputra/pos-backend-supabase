<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cashier_id' => 'required',
            'items' => 'required|array',
            'items.*.products_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'transaction_number' => 'TRX-' . strtoupper(uniqid()),
            'cashier_id' => $validatedData['cashier_id'],
            'total_price' => collect($validatedData['items'])->sum(function ($item) {
                return Product::find($item['products_id'])->price * $item['quantity'];
            }),
            'total_item' => collect($validatedData['items'])->sum('quantity'),
            'payment_method' => $request->input('payment_method', 'cash'),
        ]);

        foreach ($validatedData['items'] as $item) {
            $order->orderItems()->create([
                'product_id' => $item['products_id'],
                'quantity' => $item['quantity'],
                'total_price' => Product::find($item['products_id'])->price * $item['quantity'],
            ]);
        }

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order->load('orderItems.product'),
        ], 201);
    }
}
