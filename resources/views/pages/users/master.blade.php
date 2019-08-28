@extends('layouts.master')

@section('content')
    <div class="container mt-2">
       <div class="row">
           <div class="col-md-4">
               <div class="list-group">
                   <a href="" class="list-group-item list-group-item-action">
                       <img src="https://via.placeholder.com/100" class="rounded-circle" alt="">
                   </a>
                   <a href="{{route('user.dashboard')}}" class="list-group-item list-group-item-action {{route::is('user.dashboard') ? 'active' : ''}}">Dashboard</a>
                   <a href="{{route('user.profile')}}" class="list-group-item list-group-item-action {{route::is('user.profile') ? 'active' : ''}}">Update Profile</a>
               </div>
           </div>
           <div class="col-md-8">
               <div class="card card-body">
                   @yield('sub-content')
               </div>
           </div>
       </div>
    </div>
@stop