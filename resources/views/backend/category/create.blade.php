@extends('backend.master')
@section('category')
opened
@endsection
@can('category create')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="section-header">
            <div class="tbl">
                <div class="tbl-row">
                    <div class="tbl-cell">
                        <h3>Category</h3>
                        <ol class="breadcrumb breadcrumb-simple">
                            <li class="active">Create</li>
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
            <form action="{{route('category.store')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="form-control-label">Category</label>
                    </div>
                    <div class="col-md-10">
                        <p class="form-control-static">
                            <input type="text" class="form-control" id="category_name" placeholder="Enter Category Name" value="{{old('category_name')}}" name="category_name">
                        </p>
                        <p>
                            @error('category_name')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <button type="submit" name="submit" class="btn btn-inline btn-secondary text-center m-auto">Submit</button>
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
@else
<div class="page-content">
    <div class="container-fluid">
        <div class="section-header">
            <div class="alert alert-warning">You Don't Have Allow To Access This</div>
        </div>
    </div>
</div>
@endcan

