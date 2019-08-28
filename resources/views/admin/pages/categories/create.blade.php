@extends('layouts.admin')


@section('navbar')
  @include('admin.partials.nav')
@stop


@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
            <h1>Add Categories</h1>
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
                {!! Form::Open(['method'=>'POST', 'action'=>'CategoriesController@store','files'=>true]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Category Name') !!}
                    {!! Form::text('name',null, ['class'=>'form-control', 'placeholder'=>'Insert category name']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description',null, ['class'=>'form-control', 'placeholder'=>'Insert category description','rows'=>10]) !!}
                </div>

                <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image">
                </div>

                <div class="form-group">
                    @csrf
                    <label for="parent_id">Parent Category</label>
                    <select class="form-control" name="parent_id" id="parent_id">
                        <option value="">Parent Category</option>
                        @foreach($parent_categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    {!! Form::submit('Add category', ['class'=>'btn btn-success']) !!}
                </div>

            {!! Form::Close() !!}
            </div>
        </div>
    </div>
@stop