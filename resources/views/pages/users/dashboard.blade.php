@extends('pages.users.master')

@section('sub-content')
    <div class="container">
        <h2>Welcome {{$user->first_name.' '.$user->last_name}}</h2>
        You can update your informations from here
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-body mt-2">
                    <a href="{{route('user.profile')}}">Update Profile</a>
                </div>
            </div>
        </div>
    </div>

@stop