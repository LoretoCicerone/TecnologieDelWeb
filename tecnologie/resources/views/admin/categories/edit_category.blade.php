@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">Edit Category</a> </div>
            <h1>Categories</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Edit Category</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-category/'.$categoryDetails->id) }}" name="edit_category" id="edit_category" novalidate="novalidate"> {{csrf_field()}}
                                <div class="control-group">
                                    <label class="control-label">Category Name</label>
                                    <div class="controls">
                                        <input type="text" name="category_name" id="category_name" value="{{ $categoryDetails->name }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Category Level</label>
                                    <div class="controls">
                                        <select name="parent_id" style="width: 220px;">
                                            <option value="0">Main Category</option>
                                            @foreach($levels as $val)
                                                <option value="{{ $val->id }}" @if($val->id == $categoryDetails->parent_id) selected @endif>{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea class="textarea_editor" name="description" id="description">{{ $categoryDetails->name }}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meta Title</label>
                                    <div class="controls">
                                        <textarea name="meta_title" id="meta_title">{{$categoryDetails->meta_title}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meta Description</label>
                                    <div class="controls">
                                        <textarea name="meta_description" id="meta_description">{{$categoryDetails->meta_description}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meta Keywords</label>
                                    <div class="controls">
                                        <textarea name="meta_keywords" id="meta_keywords">{{$categoryDetails->meta_keywords}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Image</label>
                                    <div class="controls">
                                        <input type="file" name="image" id="image">
                                        <input type="hidden" name="current_image" value="{{ $categoryDetails->image }}">
                                        @if(!empty($categoryDetails->image))
                                            <img style="width: 50px;" src="{{ asset('/images/backend_images/categories/small/'.$categoryDetails->image) }}"> |
                                            <a href="{{url('/admin/delete-category-image/'.$categoryDetails->id)}}">Delete</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">URL</label>
                                    <div class="controls">
                                        <input type="text" name="url" id="url" value="{{ $categoryDetails->url }}">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Edit Category" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
