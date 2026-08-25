<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\LowStockAlertMail;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy("created_at", "desc")->paginate(10);
        return response()->json([
            'data' => OrderResource::collection($orders),
        ]);
    }
    public function store(OrderRequest $request, OrderService $orderService)
    {

        $order = $orderService->create($request->validated());
        if ($order==null) {
            return response()->json([
                'message' => 'Not enough stock for one or more ingredients.',
            ], 400);
        };

        return response()->json([
            'message' => 'Order created successfully',
            'data' => new OrderResource($order->load('orderItems')),
        ], 201);
    }
}
