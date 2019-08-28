<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderedProduct;
use PDF;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.pages.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $order = Order::findOrFail($id);
        $order->is_seen_by_admin = 1;
        $order->save();
        return view('admin.pages.orders.show', compact('order'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $order = OrderedProduct::findOrFail($id);
        $order->product_quantity = $request->product_quantity;
        $order->save();
        return back();
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
        $order = Order::findOrFail($id);
        $order->delete();
        return back();
    }
    public function delete($id)
    {
        //
        $order = OrderedProduct::findOrFail($id);
        $order->delete();
        return back();
    }

    public function completed($id)
    {
        //
        $order = Order::findOrFail($id);
        if ($order->is_completed){
            $order->is_completed = 0;
        }
        else{
            $order->is_completed = 1;
        }
        $order->save();
        return back();

    }
    public function paid($id)
    {
        //
        $order = Order::findOrFail($id);
        if ($order->is_paid){
            $order->is_paid = 0;
        }
        else{
            $order->is_paid = 1;
        }
        $order->save();
        return back();
    }


    public function chargeUpdate(Request $request,$id)
    {
        $order = Order::findOrFail($id);
        $order->shipping_charge = $request->shipping_charge;
        $order->custom_discount = $request->custom_discount;
        $order->save();
        return back();
    }

    public function generateInvoice($id)
    {
        $order = Order::find($id);
        $pdf = PDF::loadView('admin.pages.orders.invoice', compact('order'));
        return $pdf->stream('invoice.pdf');

    }
}
