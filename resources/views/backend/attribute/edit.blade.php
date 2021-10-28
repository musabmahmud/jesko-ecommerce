@extends('backend.master')
@section('product')
opened
@endsection
@can('attribute edit')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="section-header">
            <div class="tbl">
                <div class="tbl-row">
                    <div class="tbl-cell">
                        <h3>Products</h3>
                        <ol class="breadcrumb breadcrumb-simple">
                            <li>Attribute</li>
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
            <form action="{{route('attribute.update',['attribute' => $attribute->id])}}" method="POST">
                {{method_field('PUT')}}
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="color">Color *</label>
                        <select class="select2-arrow" id="color" name="color">
                            @foreach ($colors as $color)
                            <option @if ($attribute->color_id == $color->id) selected @endif value="{{ $color->id }}">
                                {{ $color->color_name }}
                            </option>
                            @endforeach
                            {{-- <option value="red">Red</option>
                            <option value="yellow">Yellow</option>
                            <option value="green">Green</option>
                            <option value="blue">Blue</option>
                            <option value="orange">Orange</option>
                            <option value="black">Black</option>
                            <option value="pink">Pink</option>
                            <option value="white">White</option>
                            <option value="purple">Purple</option>
                            <option value="gray">Gray</option> --}}
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
                            <option value="{{$attribute->size}}" selected>{{$attribute->size}}</option>
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
                    <div class="col-md-6">
                        <label class="form-control-label" for="quantity">Quantity *</label>
                        <p class="form-control-static">
                            <input type="number" min="0" class="form-control" id="quantity" placeholder="Quantity" value="{{$attribute->quantity}}" name="quantity">
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
                            <input type="number" min="0" class="form-control" id="price" placeholder="Price" value="{{$attribute->price}}" name="price">
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
                            <input type="number" min="0" class="form-control" id="offer_price" placeholder="Offer Price" value="{{$attribute->offer_price}}" name="offer_price">
                        </p>
                    </div>
                    <div class="col-md-12">
                        <a href="{{route('attributeIndex',$id)}}" class="btn btn-primary m-l">Back</a>
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