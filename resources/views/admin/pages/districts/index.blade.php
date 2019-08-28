@extends('layouts.admin')


@section('navbar')
    @include('admin.partials.nav')
@stop


@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1>Manage Districts</h1>
                <hr>
                @if(Session::has('add_district'))
                    <h2 class="bg-success">{{Session('add_district')}}</h2>
                @endif
                @if(Session::has('update_district'))
                    <h2 class="bg-success">{{Session('update_district')}}</h2>
                @endif
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Division</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    @foreach($districts as $district)
                        <tbody>
                        <tr>
                            <th scope="row">#</th>
                            <td>{{$district->name}}</td>
                            <td>{{$district->division->name}}</td>

                            <td>{{$district->created_at->diffForHumans()}}</td>
                            <td>{{$district->updated_at->diffForHumans()}}</td>

                            <td>
                                <a href="{{route('admin.districts.edit',$district->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                <br><a href="#deleteModal{{$district->id}}" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{$district->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Are you sure want to delete?</h4>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::Open(['method'=>'DELETE', 'action'=>['DistrictsController@destroy', $district->id]]) !!}
                                                <div class="form-group">
                                                    {!! Form::submit('Permanent Delete', ['class'=>'btn btn-danger']) !!}
                                                </div>
                                                {!! Form::Close() !!}
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
                </table>
            </div>
        </div>
    </div>
@stop