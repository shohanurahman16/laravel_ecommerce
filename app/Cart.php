<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    //
    public $fillable=[
        'user_id',
        'ip_address',
        'product_id',
        'product_quantity',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function order() {
        return $this->hasMany(Order::class);
    }
    public function ordered_products() {
            return $this->hasMany(OrderedProduct::class);
        }

    /*
    |--------------------------------------------------------------------------
    | Total carts--
    |--------------------------------------------------------------------------
    */

    public static function totalCarts()    {
        if (Auth::check()){
            $carts= Cart::where('user_id', Auth::id())
                ->orWhere('ip_address', request()->ip())
                ->get();
        }
        else{
            $carts= Cart::where('ip_address', request()->ip())
                ->get();
        }

        return $carts;
    }


    /*
    |--------------------------------------------------------------------------
    | Total cart items--- return Integer
    |--------------------------------------------------------------------------
    */

    public static function totalItems()    {
        $carts = Cart::totalCarts();
        $total_item = 0;
        foreach($carts as $cart)    {
            $total_item += $cart->product_quantity;
        }
        return $total_item;
    }


}
