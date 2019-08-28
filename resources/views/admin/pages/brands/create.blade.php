@extends('layouts.admin')


@section('navbar')
  @include('admin.partials.nav')
@stop


@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
            <h1>Add Brands</h1>
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
                {!! Form::Open(['method'=>'POST', 'action'=>'BrandsController@store','files'=>true]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'brand Name') !!}
                    {!! Form::text('name',null, ['class'=>'form-control', 'placeholder'=>'Insert brand name']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description',null, ['class'=>'form-control', 'placeholder'=>'Insert brand description','rows'=>10]) !!}
                </div>

                <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image">
                </div>

                <div class="form-group">
                    {!! Form::submit('Add brand', ['class'=>'btn btn-success']) !!}
                </div>

            {!! Form::Close() !!}
            </div>
        </div>
    </div>
@stop