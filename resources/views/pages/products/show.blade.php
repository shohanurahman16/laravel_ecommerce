@extends('layouts.master')

@section('title')
    {{$product->title}}
    @endsection

@section('sidebar-content')
    {{--Sidebar+Content--}}
    <div class="container margin-top-20">
        @if(Session::has('success'))
            <h2 class="bg-success">{{Session('success')}}</h2>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @php $i=1 @endphp
                        @foreach($product->images as $image)
                            <div class="carousel-item {{$i == 1? 'active' : ''}}">
                                <img class="d-block w-100" height="350px" width="250px" src="{{asset('images/products/'.$image->image)}}" alt="First slide">
                            </div>
                        @php $i++ @endphp
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="mt-3 text-center">
                    <p>Category <span class="badge badge-info">{{$product->category->name}}</span></p>
                    <p>Brand <span class="badge badge-info">{{$product->brand->name}}</p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="widget">
                    <h2>{{$product->title}}</h2>
                    <h3>Price ${{$product->price}}</h3>
                    <h4>
                    <span class="badge badge-primary">
                        {{($product->quantity <1 ? 'No product available' : $product->quantity.' item/s in stock')}}
                    </span>
                        <p>@include('pages.products.cart-button')</p>

                    </h4>
                    <hr>
                    <div class="product-description">
                        {{$product->description}}
                    </div>
                </div>

            </div>
        </div>

    </div>
    {{--Sidebar+Content Ends--}}
@stop
