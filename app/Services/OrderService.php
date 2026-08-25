<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\LowStockAlertMail;

class OrderService
{
    public function create($orderdata): Order|null
    {
        $order = DB::transaction(function () use ($orderdata) {

            $order = Order::create();

            $validatedProductIds=collect($orderdata['orderItems'])->pluck('product_id','quantity')->toArray();

            $product=Product::with(['ingredients','ingredients.stock'])
            ->whereIn('id',array_keys($validatedProductIds))->get();

            foreach($product as $product){
                foreach($product->ingredients as $ingredient){

                    $stock=$ingredient->stock;
                    $requiredQuantity=$ingredient->pivot->quantity * $validatedProductIds[$product->id];

                    if($stock->quantity < $requiredQuantity){
                      return null;
                    }

                    $stock->decrement('quantity', $requiredQuantity);


                    if ($stock->quantity < $ingredient->initial_quantity * 0.5 && !$stock->low_stock_alert_sent) {
                        Mail::to('admin-email@gmail.com')->send(new LowStockAlertMail($stock));
                        $stock->update(['low_stock_alert_sent' => true,]);
                    }
                }
            }

            return $order;
        });
        return $order;

    }
}

