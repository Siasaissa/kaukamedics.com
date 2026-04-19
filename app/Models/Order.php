<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'city', 'address',
        'payment_method', 'total', 'items'
    ];

    protected $casts = [
        'items' => 'array',  // Laravel will automatically convert JSON to array
    ];

    // Remove this: it's wrong for your current setup
    // public function order()
    // {
    //     return $this->belongsTo(Order::class);
    // }
}
