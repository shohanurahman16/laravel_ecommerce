<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $fillable=[
        'user_id',
        'ip_address',
        'payment_id',
        'email',
        'name',
        'phone_no',
        'shipping_address',
        'message',
        'is_paid',
        'transaction_id',
        'is_completed',
        'is_seen_by_admin'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function carts() {
        return $this->belongsTo(Cart::class);
    }
    public function product() {
        return $this->hasMany(Product::class);
    }
    public function ordered_products() {
        return $this->hasMany(OrderedProduct::class);
    }
    public function payment() {
        return $this->belongsTo(Payment::class);
    }
}
