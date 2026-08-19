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

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy("created_at","desc")->paginate(10);
        return response()->json([
            'data' => OrderResource::collection($orders),
        ]);
    }
    public function store(OrderRequest $request)
    {
         $order = DB::transaction(function () use ($request) {

            $order = Order::create();

            foreach ($request->validated()['order_items'] as $item)
            {
                $order->orderItems()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ]);
                $product = Product::with('ingredients')->findOrFail($item['product_id']);
                foreach ($product->ingredients as $ingredient) {

                    $stock = $ingredient->stocks()->first();
                    $consumedQuantity =$ingredient->pivot->quantity * $item['quantity'];
                    $stock->decrement('quantity', $consumedQuantity);

                    if ($stock->quantity < $ingredient->initial_quantity * 0.5 && !$stock->low_stock_alert_sent)
                         {
                          Mail::to('admin-email@gmail.com')->send(new LowStockAlertMail($stock));
                          $stock->update(['low_stock_alert_sent' => true,]);
                         }



                }
            }

            return $order;
        });

        return response()->json([
            'message' => 'Order created successfully',
            'data' => new OrderResource($order->load('orderItems')),
        ], 201);
    }

    }





