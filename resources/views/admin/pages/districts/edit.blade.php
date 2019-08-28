@extends('layouts.admin')


@section('navbar')
    @include('admin.partials.nav')
@stop


@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit Districts</h1>
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
                <form action="{{route('admin.districts.update', $district->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">District Name</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{$district->name}}">
                    </div>
                    <div class="form-group">
                        <label for="Division">Select Division</label>
                        <select name="division_id" id="Division" class="form-control">
                            <option value="">Please select a Division for this district</option>
                            @foreach($divisions as $division)
                                <option value="{{$division->id}}" {{$division->id == $district->division->id ? 'selected': ''}}>{{$division->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update District</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop