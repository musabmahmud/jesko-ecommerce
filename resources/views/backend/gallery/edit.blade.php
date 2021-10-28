@extends('backend.master')
@section('product')
opened
@endsection
@can('gallery edit')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="section-header">
            <div class="tbl">
                <div class="tbl-row">
                    <div class="tbl-cell">
                        <h3>Products</h3>
                        <ol class="breadcrumb breadcrumb-simple">
                            <li>gallery</li>
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
            <form action="{{route('gallery.update',['gallery' => $gallery->id])}}" enctype="multipart/form-data" method="POST">
                {{method_field('PUT')}}
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-control-label">Gallery *</label>
                        <p class="form-control-static">
                            <input type="file" class="form-control" id="gallery_name" name="gallery_name" onchange="document.getElementById('image_id').src= window.URL.createObjectURL(this.files[0])">
                        </p>
                        <p>
                            @error('gallery_name')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset('galleries')}}/{{$gallery->gallery_name}}" alt="Product Image" height="100" width="100" id="image_id">
                    </div>
                    <div class="col-md-12">
                        <a href="{{route('galleryIndex',$id)}}" class="btn btn-primary m-l">Back</a>
                        <button type="submit" name="submit" class="btn btn-inline btn-secondary text-center m-auto">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!--.container-fluid-->
</div><!--.page-content-->
@endsection

@else
<div class="page-content">
    <div class="container-fluid">
        <div class="section-header">
            <div class="alert alert-warning">You Don't Have Allow To Access This</div>
        </div>
    </div>
</div>
@endcan

