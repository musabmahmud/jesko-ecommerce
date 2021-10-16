@extends('backend.master')
@section('category')
opened
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="section-header">
            <div class="tbl">
                <div class="tbl-row">
                    <div class="tbl-cell">
                        <h3>Category</h3>
                        <ol class="breadcrumb breadcrumb-simple">
                            <li class="active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-typical box-typical-padding">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{route('category.update',['category' => $category->id])}}" method="POST">
                {{method_field('PUT')}}
                @csrf
                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="form-control-label">Category</label>
                    </div>
                    <div class="col-md-10">
                        <p class="form-control-static">
                            <input type="text" class="form-control" id="category_name" placeholder="Enter Category Name" value="{{$category->category_name}}" name="category_name">
                        </p>
                        <p>
                            @error('category_name')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <a href="{{route('category.index')}}" class="btn btn-inline btn-primary m-l">Back</a>
                    <button type="submit" name="update" class="btn btn-inline btn-secondary text-center m-auto">Update</button>
                </div>
            </form>
        </div>
        {{-- <div class="row">
            <div class="col-md-12">
                
            </div><!--.col-->
        </div><!--.row--> --}}
    </div><!--.container-fluid-->
</div><!--.page-content-->
@endsection

