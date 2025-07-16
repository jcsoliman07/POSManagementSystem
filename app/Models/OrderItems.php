<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItems extends Model
{
    //
    use HasFactory;
    
    protected $guarded = [];

    public function order():BelongsTo
    {
        return $this->belongsTo(Orders::class);
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Products::class);
    }

    //Computed Price and Quantity
    public function getTotalPriceAttribute()
    {
        return $this->product->price *  $this->quantity;
    }
}
