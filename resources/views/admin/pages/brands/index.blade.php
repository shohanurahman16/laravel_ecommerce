@extends('layouts.admin')


@section('navbar')
    @include('admin.partials.nav')
@stop


@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1>Manage Brands</h1>
                <hr>
                @if(Session::has('add_brand'))
                    <h2 class="bg-success">{{Session('add_brand')}}</h2>
                @endif
                @if(Session::has('update_brand'))
                    <h2 class="bg-success">{{Session('update_brand')}}</h2>
                @endif
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">S/L</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    @php $i=1; @endphp
                    @foreach($brands as $brand)
                        <tbody>
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->description}}</td>
                            <td>
                                @if($brand->image)
                                    <img src="{{asset('images/brands/'. $brand->image)}}" alt="" height="50px" width="50px">
                                @endif
                            </td>
                            <td>{{$brand->created_at->diffForHumans()}}</td>
                            <td>{{$brand->updated_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('admin.brands.edit',$brand->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                <br><a href="#deleteModal{{$brand->id}}" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{$brand->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Are you sure want to delete?</h4>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::Open(['method'=>'DELETE', 'action'=>['BrandsController@destroy', $brand->id]]) !!}
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
                        @php $i++; @endphp
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop