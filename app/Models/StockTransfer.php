<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransfer extends Model
{
    protected $fillable = [
        'product_id',
        'from_warehouse_id',
        'to_warehouse_id',
        'quantity',
        'notes',
    ];
}
