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
    public function toWarehouse()
{
    return $this->belongsTo(Warehouse::class, 'to_warehouse_id');
}

public function fromWarehouse()
{
    return $this->belongsTo(Warehouse::class, 'from_warehouse_id');
}public function product()
{
    return $this->belongsTo(Product::class);
}
}
