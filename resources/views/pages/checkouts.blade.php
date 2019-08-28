@extends('layouts.master')

@section('content')
    <div class="container margin-top-20 ">
        <div class="card card-body">
            <h1>Confirm Items</h1>
            <hr>
           <div class="row">
               <div class="col-md-7">
                   @foreach(App\Cart::totalCarts() as $cart)
                       <p>
                           {{$cart->product->title}} -
                           <b>{{$cart->product_quantity}}</b> item/s -
                           Cost <b> ${{$cart->product->price * $cart->product_quantity}} </b>
                       </p>
                   @endforeach
                   <form action="{{route('carts')}}" method="get" class="form-inline">
                       @csrf
                       <button class="btn btn-warning">Change Cart Items</button>
                   </form>
               </div>
               <div class="col-md-5">
                   @php
                       $total_price = 0;
                   @endphp
                   @foreach(App\Cart::totalCarts() as $cart)
                       @php
                           $total_price += $cart->product->price * $cart->product_quantity;
                       @endphp
                   @endforeach

                   <p>Total Price: <b>$ {{$total_price}}</b></p>
                   <p>Total Price with Shipping Cost: <b>$ {{$total_price+ App\Setting::first()->shipping_cost}}</b></p>

               </div>
           </div>
        </div>

        <div class="card card-body mt-3">
            <h1>Confirm Shipping Address</h1>
            <hr>

            @if(Session::has('trid_error'))
                <h2 class="bg-danger text-center">{{Session('trid_error')}}</h2>
            @endif
            <form method="POST" action="{{ route('checkouts.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Receiver Name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::check() ? Auth::user()->first_name.' '. Auth::user()->last_name: ''}}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::check() ? Auth::user()->email: ''}}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                    <div class="col-md-6">
                        <input id="phone_no" type="text" class="form-control{{ $errors->has('phone_no') ? ' is-invalid' : '' }}" name="phone_no" value="{{Auth::check() ? Auth::user()->phone_no: ''}}" required>

                        @if ($errors->has('phone_no'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_no') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Additional Message (optional)') }}</label>

                    <div class="col-md-6">
                        <textarea id="message" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" rows="4" autofocus></textarea>
                        @if ($errors->has('message'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="shipping_address" class="col-md-4 col-form-label text-md-right">{{ __('Shipping Address') }}</label>

                    <div class="col-md-6">
                        <textarea id="shipping_address" class="form-control{{ $errors->has('shipping_address') ? ' is-invalid' : '' }}" name="shipping_address" rows="4" autofocus>{{Auth::check() ? Auth::user()->shipping_address: '' }}</textarea>
                        @if ($errors->has('shipping_address'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('shipping_address') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="payment_method" class="col-md-4 col-form-label text-md-right">{{ __('Select a Payment Method') }}</label>
                    <div class="col-md-6 text-center">
                        <select class="form-control" name="payment_method_id" required id="payments">
                            <option value="">Select a payment method please</option>
                            @foreach(App\Payment::orderBy('priority','asc')->get() as $payment_by)
                                <option value="{{$payment_by->short_name}}">{{$payment_by->name}}</option>
                                @endforeach
                        </select>
                        <br>
                        @foreach(App\Payment::orderBy('priority','asc')->get() as $payment_by)
                                @if($payment_by->short_name == 'cash_in')
                                <div id="payment-{{$payment_by->short_name}}" class="hidden  alert alert-success">
                                        <h3>You can proceed to order</h3>
                                        <small>You will get your products within 3 working days</small>
                                    </div>
                                @else
                                <div id="payment-{{$payment_by->short_name}}" class="hidden  alert alert-success">
                                    <h3>{{$payment_by->name}} Payment</h3>
                                        <p>
                                            <strong>{{$payment_by->name}} No: {{$payment_by->no}}</strong><br>
                                            <strong>Account Type: {{$payment_by->type}}</strong>
                                        </p>
                                        <div class="alert alert-success">
                                            Please send the total money in this above Number and give us your Transaction Id in the below box.
                                        </div>

                                </div>
                                @endif
                        @endforeach
                        <div id="transaction_id" class="hidden alert alert-success">
                            <label for="transaction">Transaction Id</label>
                            <input id="transaction" type="text" name="transaction_id" class="form-control">
                        </div>

                    </div>

                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Confirm Order') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@stop


@section('scripts')
    <script type="text/javascript">
        $("#payments").change(function () {
            $payment_method = $('#payments').val();
            if ($payment_method == 'cash_in'){
                $("#payment-cash_in").removeClass('hidden');
                $("#payment-bkash").addClass('hidden');
                $("#payment-rocket").addClass('hidden');
            }
            else if($payment_method == 'bkash'){
                $("#payment-bkash").removeClass('hidden');
                $("#transaction_id").removeClass('hidden');
                $("#payment-cash_in").addClass('hidden');
                $("#payment-rocket").addClass('hidden');
            }
            else if($payment_method == 'rocket'){
                $("#payment-rocket").removeClass('hidden');
                $("#transaction_id").removeClass('hidden');
                $("#payment-bkash").addClass('hidden');
                $("#payment-cash_in").addClass('hidden');
            }
        })
    </script>
    @stop