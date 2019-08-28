@extends('layouts.admin')


@section('navbar')
    @include('admin.partials.nav')
@stop


@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1>Manage Orders</h1>
                <hr>
                @if(Session::has('add_category'))
                    <h2 class="bg-success">{{Session('add_category')}}</h2>
                @endif
                @if(Session::has('update_category'))
                    <h2 class="bg-success">{{Session('update_category')}}</h2>
                @endif
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order Id</th>
                        <th scope="col">Orderer Name</th>
                        <th scope="col">Orderer Phone No</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    @foreach($orders as $order)
                        <tbody>
                        <tr>
                            <th scope="row">{{$loop->index+1}}</th>
                            <td>#LE{{$order->id}}</td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->phone_no}}</td>
                            <td>
                                <p>
                                    @if($order->is_seen_by_admin)
                                        <button type="button" class="btn btn-success btn-sm">Seen</button>
                                    @else
                                        <button type="button" class="btn btn-warning btn-sm">Unseen</button>
                                    @endif
                                </p>
                                <p>
                                    @if($order->is_completed)
                                        <button type="button" class="btn btn-success btn-sm">Completed</button>
                                    @else
                                        <button type="button" class="btn btn-warning btn-sm">Incomplete</button>
                                    @endif
                                </p>
                               <p>
                                   @if($order->is_paid)
                                       <button type="button" class="btn btn-success btn-sm">Paid</button>
                                   @else
                                       <button type="button" class="btn btn-danger btn-sm">Not Paid</button>
                                   @endif
                               </p>
                            </td>
                            <td>{{$order->created_at->diffForHumans()}}</td>
                            <td>{{$order->updated_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('admin.orders.show',$order->id)}}"  class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                <br><br>
                                <a href="#deleteModal{{$order->id}}" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{$order->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Are you sure want to delete?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('admin.orders.delete', $order->id)}}" method="post">
                                                    @csrf
                                                    <input type="submit" value="Permanent Delete" class="btn btn-danger">
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                    <tfoot>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order Id</th>
                        <th scope="col">Orderer Name</th>
                        <th scope="col">Orderer Phone No</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@stop