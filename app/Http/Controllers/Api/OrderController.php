<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Log\Logger;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService, protected Logger $logger)
    {
        //
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            $order = $this->orderService->createOrder($validatedData, $request->user());

            $order->load('cashier', 'orderItems.product');

            return (new OrderResource($order))
                ->response()
                ->setStatusCode(201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            $this->logger->error('Order creation failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Terjadi kesalahan pada server saat membuat pesanan.'
            ], 500);
        }
    }
}
