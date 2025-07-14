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
    
    protected $fillable = ['user_id', 'total_amount',];

    //Formatted Order Number
    protected static function booted()
    {
        static::created(function($order)
        {
            $order->order_number = '#ORD-' . $order->created_at->format('Ymd') . '-' . str_pad($order->id, 4, '0', STR_PAD_LEFT);
            $order->saveQuietly();
        });
    }

    public function getFormattedCreatedAttributes()
    {
        $createdAt = $this->created_at;

        if ($createdAt->isToday()) {
            return 'Today, ' . $createdAt->format('h:i A');
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
