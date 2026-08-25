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

public function stockTransfers()
{
    return $this->hasMany(StockTransfer::class);
}
public function ingredients()
{
    return $this->belongsToMany(Ingredient::class,'product_ingredients')->withPivot('quantity');
}
}
