<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice #LE</title>
</head>
<body>
<div>
    <div>
        <div>
            Order No- <b>LE#{{$order->id}}</b>
            <h2>Laravel Ecommerce</h2>
            Sector 5, Uttara, Dhaka 1230 <br>
            Phone: +880 1912885974 <br>
            Email: laravelecommerce01@gmail.com
            <br>
            <h3>Order Informations</h3>
            <hr>
            <div>
                <div style="float: left;">
                    <p><b>Orderer Name: {{$order->name }}</b></p>
                    <p><b>Orderer Phone No. :</b> {{$order->phone_no}}</p>
                    <p><b>Orderer Email: </b>{{$order->email}}</p>
                    <p><b>Orderer Shipping Address: </b>{{$order->shipping_address}}</p>
                </div>
                <div>
                    <p><b>Order Payment Method: </b>{{$order->payment->name}}</p>
                    <p><b>Order Payment Transaction: </b>{{$order->transaction_id}}</p>
                    <p><b>Order Made On: </b>{{$order->created_at}}</p>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div style="clear: both;">
            <h2>Ordered Items</h2>
            <table border="1">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>product <br>Image</th>
                    <th>product <br> Quantity</th>
                    <th>Unit <br>Price</th>
                    <th>Sub-total <br>Price</th>
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
                        <td> {{$ordered->product_quantity}}</td>

                        <td>
                            $ {{$ordered->product->price}}
                        </td>

                        <td>
                            @php
                                $total_price += $ordered->product->price * $ordered->product_quantity;
                            @endphp
                            $ {{$ordered->product->price * $ordered->product_quantity}}
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
            <hr>
            <h3>Total Payable</h3>
             <table border="1">
                <thead>
                 </thead>
                 <tbody>
                   <tr>
                     <td colspan="4"> Total Price: </td>
                     <td><b>${{$total_price}}</b></td>
                   </tr>
                   <tr>
                     <td colspan="4"> Shipping Charge : </td>
                     <td> <b>${{$order->shipping_charge}}</b></b></td>
                   </tr>
                   <tr>
                     <td colspan="4">  Discount:  </td>
                     <td> <b>${{$order->custom_discount}}</b></td>
                   </tr>
                   <tr>
                     <td colspan="4">  Total Payable  </td>
                     <td> <b>${{$total_price + $order->shipping_charge - $order->custom_discount}}</b></td>
                   </tr>
                </tbody>
              </table>
            <br>
            <br>
            -------------------------<br>
            signature of customer
        </div>
    </div>
</div>
<footer style="text-align: center">
    <hr>
    <br>
    Thank you for doing business with us
</footer>
</body>
</html>