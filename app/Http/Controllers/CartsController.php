<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carts = Cart::totalCarts();
        return view('pages.carts', compact('carts'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
                'product_id' => 'required',
            ],
            [
                'product_id.required' => 'Please select a product',
            ]);

       if (Auth::check())   {
           $cart= Cart::where('user_id', Auth::id())
               ->where('product_id', $request->product_id)
               ->first();
       }
       else{
           $cart= Cart::where('ip_address', request()->ip())
               ->where('product_id', $request->product_id)
               ->first();
       }

        if(!is_null($cart)){
                $cart->increment('product_quantity');
        }
        else{
            $cart = new Cart();
            if (Auth::check()){
                $cart->user_id = Auth::id();
            }
            $cart->ip_address = request()->ip();
            $cart->product_id = $request->product_id;
            $cart->save();
        }
        Session::flash('success', 'Product has been added to cart');
        return back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $cart = Cart::findOrFail($id);
        if(!is_null($cart)){
            $cart->product_quantity = $request->product_quantity;
            $cart->save();
            Session::flash('success','Cart Item has been updated successfully');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $cart = Cart::findOrFail($id);
        if(!is_null($cart)){
        $cart->delete();
        Session::flash('delete','Cart Item has been deleted successfully');
        return back();
        }
    }
}
