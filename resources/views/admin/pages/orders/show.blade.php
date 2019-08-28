@extends('layouts.admin')


@section('navbar')
    @include('admin.partials.nav')
@stop


@section('content')
    <div id="page-wrapper">
           <div class="row">
               <div class="col-md-12">
                   <h2>Order Informations</h2>
                   <hr>
                   <div class="row">
                       <div class="col-md-6">
                           Order No- <b>LE{{$order->id}}</b>
                           <h4>
                               <b>Orderer Name: {{$order->name }}</b>
                           </h4>
                           <p><b>Orderer Phone No. :</b> {{$order->phone_no}}</p>
                           <p><b>Orderer Email: </b>{{$order->email}}</p>
                           <p><b>Orderer Shipping Address: </b>{{$order->shipping_address}}</p>
                       </div>

                       <div class="col-md-6">
                           <p><b>Order Payment Method: </b>{{$order->payment->name}}</p>
                           <p><b>Order Payment Transaction: </b>{{$order->transaction_id}}</p>
                       </div>
                   </div>
               </div>
           </div>
        <hr>

        <div class="row">
            <div class="col-md-12">
                <h2>Ordered Items</h2>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>product Image</th>
                            <th>product Quantity</th>
                            <th>Unit Price</th>
                            <th>Sub-total Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total_price = 0;
                        @endphp

                        @foreach($order->ordered_products as $ordered)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                    <a href="{{route('products.show',$ordered->product->slug)}}">{{$ordered->product->title}}</a>
                                </td>
                                <td>
                                    @if($ordered->product->images->count() > 0)
                                        <img src="{{asset('images/products/'.$ordered->product->images->first()->image)}}" alt="" height="50px" width="100px">
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('admin.orders.update',$ordered->id)}}" method="post" class="form-inline">
                                        @csrf
                                        <input type="number" name="product_quantity" class="form-control" min="1" value="{{$ordered->product_quantity}}">
                                        <button type="submit" class="btn btn-success ml-1">Update</button>
                                    </form>
                                </td>

                                <td>
                                    $ {{$ordered->product->price}}
                                </td>

                                <td>
                                    @php
                                        $total_price += $ordered->product->price * $ordered->product_quantity;
                                    @endphp
                                    $ {{$ordered->product->price * $ordered->product_quantity}}
                                </td>
                                <td>
                                    <form action="{{route('admin.orders.deletee',$ordered->id)}}" method="post" class="form-inline">
                                        @csrf
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4"></td>
                            <td>
                                Total Price
                            </td>
                            <td>
                                <b>$ {{$total_price}}</b>
                            </td>
                        </tr>
                        </tbody>
                    </table>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                    <form action="{{route('admin.orders.charge',$order->id)}}" method="post">
                        @csrf
                        <div class="col-md-4">
                            <label for="shipping_charge">Shipping Charge</label>
                            <input id="shipping_charge" type="number" name="shipping_charge" class="form-control" value="{{$order->shipping_charge}}">
                        </div>
                        <div class="col-md-4">
                            <label for="custom_discount">Custom Discount</label>
                            <input id="custom_discount" type="number" name="custom_discount" class="form-control" value="{{$order->custom_discount}}">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success btn-lg ml-1 col-md-2">Update</button>
                        <a href="{{route('admin.orders.invoice', $order->id)}}" target="_blank" class="col-md-2 btn btn-warning btn-lg">Generate Invoice</a>
                    </form>
            </div>
        </div>
        <hr>

        <div class="row order-now">
            <div class="col-md-12 text-center">
                <form action="{{route('admin.orders.completed', $order->id)}}" method="post" style="display: inline-block;">
                    @csrf
                    @if($order->is_completed)
                        <input type="submit" value="Cancel Order" name="is_completed" class="btn btn-success">
                        @else
                        <input type="submit" value="Complete Order" name="is_completed" class="btn btn-danger">
                        @endif
                </form>

                <form action="{{route('admin.orders.paid', $order->id)}}" method="post" style="display: inline-block;">
                    @csrf
                    @if($order->is_paid)
                        <input type="submit" value="Decline Payment" class="btn btn-success">
                    @else
                        <input type="submit" value="Paid Order"  class="btn btn-danger">
                    @endif
                </form>
            </div>
        </div>
       </div>
@stop