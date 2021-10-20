@extends('backend.master')
@section('product')
opened
@endsection
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
            <form action="{{route('attribute.store')}}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$id}}"/>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="color">Color *</label>
                        <select class="select2-arrow" id="color" name="color">
                            <option value="" selected>Choose Color</option>
                            <option value="red">Red</option>
                            <option value="yellow">Yellow</option>
                            <option value="green">Green</option>
                            <option value="blue">Blue</option>
                            <option value="orange">Orange</option>
                            <option value="black">Black</option>
                            <option value="pink">Pink</option>
                            <option value="white">White</option>
                            <option value="purple">Purple</option>
                            <option value="gray">Gray</option>
                        </select>
                        <p>
                            @error('color')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label" for="size">Size *</label>
                        <select class="select2-arrow" id="size" name="size">
                            <option value="" selected>Choose Size</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                            <option value="Any">Any</option>
                        </select>
                        <p>
                            @error('size')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label" for="quantity">Quantity *</label>
                        <p class="form-control-static">
                            <input type="number" min="0" class="form-control" id="quantity" placeholder="Quantity" value="{{old('quantity')}}" name="quantity">
                        </p>
                        <p>
                            @error('quantity')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Price *</label>
                        <p class="form-control-static">
                            <input type="number" min="0" class="form-control" id="price" placeholder="Price" value="{{old('price')}}" name="price">
                        </p>
                        <p>
                            @error('price')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Offer Price</label>
                        <p class="form-control-static">
                            <input type="number" min="0" class="form-control" id="offer_price" placeholder="Offer Price" value="{{old('offer_price')}}" name="offer_price">
                        </p>
                    </div>
                </div>
                <a href="{{route('attributeIndex',$id)}}" class="btn btn-primary m-l">Back</a>
                <button type="submit" name="submit" class="btn btn-inline btn-secondary text-center m-auto">Submit</button>
            </form>
        </div>
    </div><!--.container-fluid-->
</div><!--.page-content-->
@endsection
