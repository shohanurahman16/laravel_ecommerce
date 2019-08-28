@extends('layouts.admin')


@section('navbar')
    @include('admin.partials.nav')
@stop


@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit Division</h1>
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
                <form action="{{route('admin.divisions.update',$division->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Division Name</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{$division->name}}">
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <input class="form-control" type="text" name="priority" id="priority" value="{{$division->priority}}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update Division</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop