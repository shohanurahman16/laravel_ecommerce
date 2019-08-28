<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    //
    public $fillable=[
        'order_id',
        'product_id',
        'product_quantity',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function carts() {
        return $this->belongsTo(Cart::class);
    }
}
