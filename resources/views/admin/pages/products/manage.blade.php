@extends('layouts.admin')


@section('navbar')
    @include('admin.partials.nav')
@stop


@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1>Manage Products</h1>
                <hr>
                @if(Session::has('deleted_product'))
                    <h2 class="bg-success">{{Session('deleted_product')}}</h2>
                @endif
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">S/L</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    @php $i=1; @endphp
                    @foreach($products as $product)
                    <tbody>
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$product->title}}</td>
                        <td>{{str_limit($product->description, 180)}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                            <a href="{{route('admin.products.edit',$product->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            <br>
                            <a href="#deleteModal{{$product->id}}" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{$product->id}}" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Are you sure want to delete?</h4>
                                        </div>
                                        <div class="modal-body">
                                            {!! Form::Open(['method'=>'DELETE', 'action'=>['AdminProductsController@destroy', $product->id]]) !!}
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
                    <tfoot>
                    <tr>
                        <th scope="col">S/L</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@stop