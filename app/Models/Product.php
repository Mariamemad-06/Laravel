<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'price',
        'description',
    ];
    public function stocks()
{
    return $this->hasMany(Stock::class);
}
public function stockTransfers()
{
    return $this->hasMany(StockTransfer::class);
}
}
