@extends('backend.master')
@section('product')
opened
@endsection
@can('product edit')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="section-header">
            <div class="tbl">
                <div class="tbl-row">
                    <div class="tbl-cell">
                        <h3>Products</h3>
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
            <form action="{{route('product.update',['product' => $product->id])}}" enctype="multipart/form-data" method="POST">
                {{method_field('PUT')}}
                @csrf
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-control-label">Product Name *</label>
                        <p class="form-control-static">
                            <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name" value="{{$product->product_name}}" name="product_name">
                        </p>
                        <p>
                            @error('product_name')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Category *</label>
                        <select class="select2-arrow" value="{{$product->category_id}}" name="category_id">
                            <option value="">Choose Category</option>
                            @foreach ($categories as $category)
                                <option @if ($product->category_id == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        <p>
                            @error('category_id')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Brand *</label>
                        <select class="select2-arrow" value="{{$product->brand_id}}" name="brand_id"  >
                            <option value="">Choose Brand</option>
                            @foreach ($brands as $brand)
                                <option @if ($product->brand_id == $brand->id) selected @endif value="{{ $brand->id }}">
                                    {{ $brand->brand_name }}
                                </option>
                            @endforeach
                        </select>
                        <p>
                            @error('brand_id')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Type</label>
                        <select class="select2-arrow" name="type_name">
                            <option value="{{$product->type_name}}" selected>{{$product->type_name}}</option>
                            <option value="men">Men</option>
                            <option value="women">Women</option>
                            <option value="kids">Kids</option>
                            <option value="default">Default</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Product Weight</label>
                        <p class="form-control-static">
                            <input type="number" min="0" class="form-control" id="product_name" placeholder="Enter product Weight(g)" value="{{$product->weight}}" name="weight">
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Thumbnail *</label>
                        <p class="form-control-static">
                            <input type="file" class="form-control" id="thumbnail" name="thumbnail" onchange="document.getElementById('image_id').src= window.URL.createObjectURL(this.files[0])">
                        </p>
                        <p>
                            @error('thumbnail')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset('products/'.$product->thumbnail)}}" alt="Product Image" height="100" width="100" id="image_id">
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Product Made Materials</label>
                        <p class="form-control-static">
                            <input type="text" class="form-control" id="materials" placeholder="Enter Product Meterials" value="{{$product->materials}}" name="materials">
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Product Short Information</label>
                        <p class="form-control-static">
                            <input type="text" class="form-control" id="short_info" placeholder="One Sentence Information" value="{{$product->short_info}}" name="short_info">
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Summary *</label>
                        <p class="form-control-static">
                            <textarea class="form-control"  name="summary" id="summary" placeholder="Enter Summary Shortly" cols="30" rows="10"  >{{$product->summary}}</textarea>
                        </p>
                        <p>
                            @error('summary')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Description *</label>
                        <p class="form-control-static">
                            <textarea class="form-control"  name="description" id="description" placeholder="Enter Description Briefly" cols="30" rows="10">{{$product->description}}</textarea>
                        </p>
                        <p>
                            @error('description')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <a href="{{route('product.index')}}" class="btn btn-inline btn-primary m-l">Back</a>
                    <button type="submit" name="update" class="btn btn-inline btn-secondary text-center m-auto">Submit</button>
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

