@extends('layouts.admin')


@section('navbar')
    @include('admin.partials.nav')
@stop


@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit brands</h1>
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
                <form action="{{route('admin.brands.update' ,$brand->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">brand Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$brand->name}}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" rows="5" id="description">{{$brand->description}}</textarea>
                </div>

                <div class="form-group">
                @if($brand->image)
                        <label for="oldimage">Old Image</label><br>
                        <img src="{{asset('images/brands/'. $brand->image)}}" alt="" height="200px" width="200px">
                @endif
                </div>
                <div class="form-group">
                    <label for="image">New Image</label>
                    <input type="file" name="image" id="image">
                </div>

                <div class="form-group">
                    <button type="submit" value="" class="btn btn-success">Update brand</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@stop