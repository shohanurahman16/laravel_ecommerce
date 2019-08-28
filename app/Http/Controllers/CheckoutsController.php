<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\OrderedProduct;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.checkouts');
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
        $this->validate($request, [
            'name' => 'required',
            'phone_no' => 'required',
            'shipping_address' => 'required',
            'payment_method_id' => 'required',
        ]);

        $order = new Order();
        //check transaction id given or not
        if($request->payment_method_id != 'cash_in'){
            if($request->transaction_id == null || empty($request->transaction_id)){
                Session::flash('trid_error','Please insert your Transaction ID');
                return back();
            }
        }
        if (Auth::check())   {
            $order->user_id = Auth::id();
        }
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone_no = $request->phone_no;
        $order->message = $request->message;
        $order->ip_address = request()->ip();
        $order->shipping_address = $request->shipping_address;
        $order->payment_id = Payment::where('short_name', $request->payment_method_id)->first()->id;
        $order->transaction_id = $request->transaction_id;
        $order->save();


        foreach (Cart::totalCarts() as $cart)   {
            $ordered = new OrderedProduct;
            $ordered->order_id = $order->id;
            $ordered->product_id = $cart->product_id;
            $ordered->product_quantity= $cart->product_quantity;
            $ordered->save();
            $cart->delete();
        }

        Session::flash('success','Your order has been successful, Please wait for admin to accept it');
        return redirect()->route('index');
    }


}
