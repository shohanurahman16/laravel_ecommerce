@extends('layouts.admin')


@section('navbar')
  @include('admin.partials.nav')
@stop


@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
            <h1>Add Products</h1>
                <hr>
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                       <ul>
                          @foreach($errors->all() as $error)
                             <li>{{$error}}</li>
                          @endforeach
                       </ul>
                   </div>
                @endif
                {!! Form::Open(['method'=>'POST', 'action'=>'AdminProductsController@store','files'=>true]) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title',null, ['class'=>'form-control', 'placeholder'=>'Insert product title']) !!}
                </div>

                <div class="form-group">
                    <label for="Category">Select Category</label>
                    <select name="category_id" id="Category" class="form-control">
                    <option value="">Please select a category for the product</option>
                    @foreach(App\Category::orderBy('name', 'asc')->where('parent_id',NULL)->get() as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                            <div class="child-rows">
                                @foreach(App\Category::orderBy('name', 'asc')->where('parent_id', $cat->id)->get() as $sub)
                                    <option value="{{$sub->id}}">-->{{$sub->name}}</option>
                                @endforeach
                            </div>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="Brand">Select Brand</label>
                    <select name="brand_id" id="Brand" class="form-control">
                        <option value="">Please select a Brand for the product</option>
                        @foreach(App\Brand::orderBy('name', 'asc')->get() as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">Upload product Image</label>
                            <input type="file" name="product_image[]" id="image">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">&nbsp;</label>
                            <input type="file" name="product_image[]" id="image">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">&nbsp;</label>
                            <input type="file" name="product_image[]" id="image">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">&nbsp;</label>
                            <input type="file" name="product_image[]" id="image">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">&nbsp;</label>
                            <input type="file" name="product_image[]" id="image">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">&nbsp;</label>
                            <input type="file" name="product_image[]" id="image">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description',null, ['class'=>'form-control', 'placeholder'=>'Insert product description']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('quantity', 'Quantity') !!}
                    {!! Form::number('quantity',null, ['class'=>'form-control', 'placeholder'=>'Insert product quantity']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('price', 'Price') !!}
                    {!! Form::number('price',null, ['class'=>'form-control', 'placeholder'=>'Insert product price']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add Product', ['class'=>'btn btn-success']) !!}
                </div>

            {!! Form::Close() !!}
            </div>
        </div>
    </div>
@stop