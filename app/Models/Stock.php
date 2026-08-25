<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'warehouse_id',
        'quantity',
        'low_stock_alert_sent',
    ];
    public function warehouse()
{
    return $this->belongsTo(Warehouse::class);
}

 public function ingredients()
{
    return $this->hasMany(Ingredient::class);
}
}
