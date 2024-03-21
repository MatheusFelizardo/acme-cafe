<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function dishes()
    {
        return $this->hasManyThrough(Dish::class, OrderItem::class);
    }

    public function voucher()
    {
        return $this->hasOne(Voucher::class);
    }

    protected $fillable = [
        'user_id',
        'total_price',
        'notes',
        'status',
        'payment_id',
        'voucher_id',
    ];
}
