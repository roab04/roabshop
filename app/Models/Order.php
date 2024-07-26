<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'address', 'email', 'phone', 'order_status', 'order_date', 'total_quantity', 'total_money'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}