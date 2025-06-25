<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItems extends Model
{
    //
    protected $guarded = [];

    public function order():BelongsTo
    {
        return $this->belongsTo(Orders::class);
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Products::class);
    }
}
