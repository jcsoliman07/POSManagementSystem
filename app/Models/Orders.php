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
    
    protected $fillable = ['user_id', 'total_amount', 'payment_method'];

    //Formatted Order Number
    protected static function booted()
    {
        static::created(function($order)
        {
            $order->order_number = '#ORD-' . $order->created_at->format('Ymd') . '-' . str_pad($order->id, 4, '0', STR_PAD_LEFT);
            $order->saveQuietly();
        });
    }
    
    //Formatted Created At
    public function getFormattedCreatedAtAttribute()
    {
        $createdAt = $this->created_at;

        if ($createdAt->isToday()) { //If the date is today or current date
            return 'Today, ' . $createdAt->format('h:i A');
        }
        elseif ($createdAt->isYesterday()){ //If the date is yesterday or previous date
            return 'Yesterday, ' . $createdAt->format('h:i A');
        }
        else{ //If the date is two or more date late
            return $createdAt->format('M-d-Y, h:i A');
        }
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items():HasMany
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }

    public function getFormattedIdAttributes()
    {

    }

}
