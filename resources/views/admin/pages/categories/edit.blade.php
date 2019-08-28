@extends('layouts.admin')


@section('navbar')
    @include('admin.partials.nav')
@stop


@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit Categories</h1>
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
                <form action="{{route('admin.categories.update' ,$category->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" rows="5" id="description">{{$category->description}}</textarea>
                </div>

                <div class="form-group">
                @if($category->image)
                        <label for="oldimage">Old Image</label><br>
                        <img src="{{asset('images/categories/'. $category->image)}}" alt="" height="200px" width="200px">
                @endif
                </div>
                <div class="form-group">
                    <label for="image">New Image</label>
                    <input type="file" name="image" id="image">
                </div>

                <div class="form-group">
                    <label for="parent_id">Parent Category</label>
                    <select class="form-control" name="parent_id" id="parent_id">
                        <option value="">Parent Category</option>
                        @foreach($parent_categories as $cat)
                            <option value="{{$cat->id}}" {{$cat->id == $category->parent_id ? 'selected' : ''}}>{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" value="" class="btn btn-success">Update Category</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@stop