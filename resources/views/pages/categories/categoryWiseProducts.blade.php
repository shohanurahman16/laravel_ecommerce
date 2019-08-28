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
                    <h2>All Products in <span class="badge badge-info">{{$category->name}}</span> Category</h2>
                    @php
                        $products = $category->products()->paginate(9);
                    @endphp

                    @if(count($products) > 0)

                        @include('partials.all_products')
                        @else
                        <div class="alert alert-warning">
                            <h1>No products in this category</h1>
                        </div>
                    @endif
                </div>

            </div>
        </div>

    </div>
    {{--Sidebar+Content Ends--}}
@stop
