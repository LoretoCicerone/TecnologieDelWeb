@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="#">Shipping</a>
                <a href="#" class="current">View Shipping</a> </div>
            <h1>Shipping Charges</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
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
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Shipping Charges</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Country</th>
                                    <th>Shipping Charges</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($shipping_charges as $shipping)
                                    <tr class="gradeX">
                                        <td>{{ $shipping->id }}</td>
                                        <td>{{ $shipping->country }}</td>
                                        <td>{{ $shipping->shipping_charges }}</td>
                                        <td class="center">
                                            <a href="{{url('admin/edit-shipping/'.$shipping->id)}}"
                                               class="btn btn-primary btn-mini">Edit</a>
                                    </tr>
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
