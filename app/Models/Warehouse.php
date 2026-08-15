<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'name',
        'location',
    ];
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function outgoingTransfers()
{
    return $this->hasMany(
        StockTransfer::class,
        'from_warehouse_id'
    );
}

public function incomingTransfers()
{
    return $this->hasMany(
        StockTransfer::class,
        'to_warehouse_id'
    );
}
}
