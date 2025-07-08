<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
    //
    use HasFactory;
    
    protected $fillable = ['user_id', 'total_amount'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items():HasMany
    {
        return $this->hasMany(OrderItems::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($order)
        {
            $year = now()->format('y'); // '25' for 2025

            //Count existing orders for the current year
            $count = static::whereYear('created_at', now()->year)->count() + 1;

            //Format: Order id #ORD-25 + increment numbers
            $order->order_numer = 'ORD-' . $year . str_pad($count, 2, 0, STR_PAD_LEFT);
        });
    }
}
