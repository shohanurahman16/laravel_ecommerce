@extends('layouts.master')

@section('content')
    <div class="container margin-top-20">
        <h2>My Cart Items</h2>
        @if(Session::has('success'))
                <h3 class="bg-success">{{Session('success')}}</h3>
            @endif
        @if(Session::has('delete'))
            <h3 class="bg-success">{{Session('delete')}}</h3>
        @endif

        @if(count($carts)>0)

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>product Image</th>
                    <th>product Quantity</th>
                    <th>Unit Price</th>
                    <th>Sub-total Price</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total_price = 0;
                @endphp

                @foreach($carts as $cart)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>
                            <a href="{{route('products.show',$cart->product->slug)}}">{{$cart->product->title}}</a>
                        </td>
                        <td>
                            @if($cart->product->images->count() > 0)
                                <img src="{{asset('images/products/'.$cart->product->images->first()->image)}}" alt="" height="50px" width="100px">
                            @endif
                        </td>
                        <td>
                            <form action="{{route('carts.update',$cart->id)}}" method="post" class="form-inline">
                                @csrf
                                <input type="number" name="product_quantity" class="form-control" min="1" value="{{$cart->product_quantity}}">
                                <button type="submit" class="btn btn-success ml-1">Update</button>
                            </form>
                        </td>

                        <td>
                            $ {{$cart->product->price}}
                        </td>

                        <td>
                            @php
                                $total_price += $cart->product->price * $cart->product_quantity;
                            @endphp
                            $ {{$cart->product->price * $cart->product_quantity}}
                        </td>
                        <td>
                            <form action="{{route('carts.delete',$cart->id)}}" method="post" class="form-inline">
                                @csrf
                                <input type="hidden" name="cart_id" >
                                <button type="submit" class="btn btn-danger">Delete</button>
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

            <div class="float-right">
                <a href="{{route('products.index')}}" class="btn btn-info btn-lg">Continue Shopping..</a>
                <a href="{{route('checkouts')}}" class="btn btn-warning btn-lg">Checkout</a>
            </div>

            @else
            <div class="col-md-6 mt-5">
            <div class="card">
                    <div class="card-body">
                        <h2>There is no product in your cart</h2>
                        <a href="{{route('products.index')}}" class="btn btn-warning btn-lg">Continue Shopping.</a>
                    </div>
                </div>
            </div>

            @endif
    </div>
@stop
