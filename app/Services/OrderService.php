<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Throwable;

class OrderService
{
    public function createOrder(array $data, User $cashier): Order
    {
        return DB::transaction(function () use ($data, $cashier) {
            $productIds = collect($data['items'])->pluck('product_id');
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

            $order = $this->createOrderRecord($data, $cashier, $products);

            $this->createOrderItems($order, $data['items'], $products);

            return $order;
        });
    }

    private function createOrderRecord(array $data, User $cashier, $products): Order
    {
        $totalPrice = collect($data['items'])->sum(function ($item) use ($products) {
            $product = $products->get($item['product_id']);
            return $product ? $product->price * $item['quantity'] : 0;
        });

        return Order::create([
            'transaction_number' => 'TRX-' . now()->timestamp . strtoupper(uniqid()),
            'cashier_id'         => $cashier->id,
            'total_price'        => $totalPrice,
            'total_item'         => collect($data['items'])->sum('quantity'),
            'payment_method'     => $data['payment_method'] ?? 'cash',
        ]);
    }

    private function createOrderItems(Order $order, array $items, $products): void
    {
        $orderItems = collect($items)->map(function ($item) use ($products) {
            $product = $products->get($item['product_id']);
            if ($product) {
                return [
                    'product_id'  => $item['product_id'],
                    'quantity'    => $item['quantity'],
                    'total_price' => $product->price * $item['quantity'],
                ];
            }
            return null;
        })->filter();

        if ($orderItems->isNotEmpty()) {
            $order->orderItems()->createMany($orderItems->all());
        }
    }
}
