@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{url ('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="">Products</a> <a href="" class="current">View Products</a> </div>
            <h1>Products</h1>
            <div style="margin-left: 170px">
                <a href="{{url('/admin/export-products')}}" class="btn btn-primary btn-mini">Esporta</a>
            </div>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>View Products</h5>
                        </div>
                        @if(Session::has('flash_message_error'))
                            <div class="alert alert-error alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{!! session('flash_message_error') !!}</strong>
                            </div>
                        @endif
                        @if(Session::has('flash_message_success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{!! session('flash_message_success') !!}</strong>
                            </div>
                        @endif
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Category ID</th>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Product Brand</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Stock</th>
                                    <th>Feature Item</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr class="gradeX">
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->category_id }}</td>
                                        <td>{{ $product->category_name }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_code }}
                                        <td>{{ $product->product_brand }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                          @if(!empty($product->image))
                                            <img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}"   style="width:70px;">
                                              @endif
                                        </td>
                                        <td>{{ $product->stock }}</td>
                                        <td>@if($product->feature_item == 1) <span style="color: green"> Yes @else <span style="color: red"> No @endif</td>
                                        <td class="center">
                                            <a href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a>
                                            <a href="{{ url('/admin/edit-product/'.$product->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                            <a rel="{{ $product->id }}" rel1=delete-product <?php /* href="{{url('admin/delete-product/'.$product->id) }}" */?> href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                                    </tr>
                                    <div id="myModal{{ $product->id }}" class="modal hide">
                                        <div class="modal-header">
                                            <button data-dismiss="modal" class="close" type="button">x</button>
                                            <h3>{{ $product->product_name }} Full Details</h3>
                                        </div>

                                        <div class="modal-body">
                                            <p>Product ID: {{ $product->id }}</p>
                                            <p>Category ID: {{ $product->category_id }}</p>
                                            <p>Product Code: {{ $product->product_code }}</p>
                                            <p>Product Brand: {{ $product->product_brand }}</p>
                                            <p>Price: {{ $product->price }} €</p>
                                            <p>Description: {{ $product->description }}</p>
                                            <p>Stock: {{ $product->stock }}</p>
                                            <p>Feature: @if($product->feature_item == 1) Yes @else  No @endif</p>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
