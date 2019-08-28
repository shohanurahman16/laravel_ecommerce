@extends('layouts.master')

@section('sidebar-content')
    {{--Sidebar+Content--}}
    <div class="container margin-top-20">

        <div class="row">
            <div class="col-md-4">
                @include('partials.product-indexpage-sidebar')
            </div>
            <div class="col-md-8">
                <div class="widget">
                    <h2>All Products</h2>
                    @if(Session::has('success'))
                        <h2 class="bg-success">{{Session('success')}}</h2>
                    @endif
                    <div class="row">

                        @foreach($products as $product)
                        <div class="col-md-4" style="margin-bottom: 10px;">
                            <div class="card">
                                @php $i=1; @endphp
                                @foreach($product->images as $image)
                                @if($i>0)
                                <img class="card-img-top feature-img" src="{{ asset('images/products/'.$image->image) }}" alt="Card image">
                                @endif
                                    @php $i--; @endphp
                                @endforeach
                                <div class="card-body feature-body">
                                    <div class="col text-center">
                                        <h3 class="card-title"><a href="{{route('products.show',$product->slug)}}">{{$product->title}}</a></h3>
                                        <p class="card-text">$ {{$product->price}}</p>
                                        @include('pages.products.cart-button')
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    </div>
    {{--Sidebar+Content Ends--}}
@stop
