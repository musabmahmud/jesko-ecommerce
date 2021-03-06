@extends('backend.master')
@section('product')
opened
@endsection
@can('product create')
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
            <form action="{{route('product.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-control-label">Product Name *</label>
                        <p class="form-control-static">
                            <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name" value="{{old('product_name')}}" name="product_name"  >
                        </p>
                        <p>
                            @error('product_name')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Category *</label>
                        <select class="select2-arrow" value="{{old('category_id')}}" name="category_id"  >
                            <option value="" selected>Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
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
                        <select class="select2-arrow" value="{{old('brand_id')}}" name="brand_id"  >
                            <option value="" selected>Choose Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
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
                            <option value="" selected>Choose Type</option>
                            <option value="men">Men</option>
                            <option value="women">Women</option>
                            <option value="kids">Kids</option>
                            <option value="default">Default</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Product Weight</label>
                        <p class="form-control-static">
                            <input type="number" min="0" class="form-control" id="product_name" placeholder="Enter product Weight(g)" value="{{old('weight')}}" name="weight">
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
                        <img src="{{asset('products/thumbnail.jpg')}}" alt="Product Image" height="100" width="100" id="image_id">
                    </div>
                    <div class="col-md-12">
                        <label class="form-control-label">Gallery * (select Multiple Image)</label>
                        <p class="form-control-static">
                            <input type="file" multiple class="form-control" id="gallery" name="gallery[]">
                        </p>
                        <p>
                            @error('gallery')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-12">
                        <div id="dynamic-field-1" class="form-group dynamic-field">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="color_id">Color *</label>
                                    <select class="select2-arrow" id="color_id" name="color_id[]">
                                        <option value="" selected>Choose Color</option>
                                        @foreach ($colors as $color)
                                            <option value="{{$color->id}}">{{$color->color_name}}</option>
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
                                        @error('color_id')
                                            <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="size">Size *</label>
                                    <select class="select2-arrow" id="size" name="size[]">
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
                                        <input type="number" min="0" class="form-control" id="quantity" placeholder="Quantity" value="{{old('quantity')}}" name="quantity[]"    >
                                    </p>
                                    <p>
                                        @error('quantity')
                                            <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-control-label">Price *</label>
                                    <p class="form-control-static">
                                        <input type="number" min="0" class="form-control" id="price" placeholder="Price" value="{{old('price')}}" name="price[]">
                                    </p>
                                    <p>
                                        @error('price')
                                            <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-control-label">Offer Price</label>
                                    <p class="form-control-static">
                                        <input type="number" min="0" class="form-control" id="offer_price" placeholder="Offer Price" value="{{old('offer_price')}}" name="offer_price[]">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 m-b-lg">
                        <button type="button" id="add-button"
                            class="btn btn-secondary float-left text-uppercase shadow-sm">
                            <i class="fa fa-plus-square"></i> Add</button>
                        <button type="button" id="remove-button"
                            class="btn btn-secondary float-left text-uppercase ml-1"
                            disabled="disabled"><i class="fa fa-minus-square"></i> Remove</button>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Product Made Materials</label>
                        <p class="form-control-static">
                            <input type="text" class="form-control" id="materials" placeholder="Enter Product Meterials" value="{{old('materials')}}" name="materials">
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Product Short Information</label>
                        <p class="form-control-static">
                            <input type="text" class="form-control" id="short_info" placeholder="One Sentence Information" value="{{old('short_info')}}" name="short_info">
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Summary *</label>
                        <p class="form-control-static">
                            <textarea class="form-control"  name="summary" id="summary" placeholder="Enter Summary Shortly" cols="30" rows="10"  >{{old('summary')}}</textarea>
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
                            <textarea class="form-control"  name="description" id="description" placeholder="Enter Description Briefly" cols="30" rows="10">{{old('description')}}</textarea>
                        </p>
                        <p>
                            @error('description')
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

@section('footer_js')
    <script>
        $(document).ready(function() {
            var buttonAdd = $("#add-button");
            var buttonRemove = $("#remove-button");
            var className = ".dynamic-field";
            var count = 0;
            var field = "";
            var maxFields = 20;

            function totalFields() {
                return $(className).length;
            }

            function addNewField() {
                count = totalFields() + 1;
                field = $("#dynamic-field-1").clone();
                field.attr("id", "dynamic-field-" + count);
                field.children("label").text("Field " + count);
                field.find("input").val("");
                $(className + ":last").after($(field));
            }

            function removeLastField() {
                if (totalFields() > 1) {
                    $(className + ":last").remove();
                }
            }

            function enableButtonRemove() {
                if (totalFields() === 2) {
                    buttonRemove.removeAttr("disabled");
                    buttonRemove.addClass("shadow-sm");
                }
            }

            function disableButtonRemove() {
                if (totalFields() === 1) {
                    buttonRemove.attr("disabled", "disabled");
                    buttonRemove.removeClass("shadow-sm");
                }
            }

            function disableButtonAdd() {
                if (totalFields() === maxFields) {
                    buttonAdd.attr("disabled", "disabled");
                    buttonAdd.removeClass("shadow-sm");
                }
            }

            function enableButtonAdd() {
                if (totalFields() === (maxFields - 1)) {
                    buttonAdd.removeAttr("disabled");
                    buttonAdd.addClass("shadow-sm");
                }
            }

            buttonAdd.click(function() {
                addNewField();
                enableButtonRemove();
                disableButtonAdd();
            });

            buttonRemove.click(function() {
                removeLastField();
                disableButtonRemove();
                enableButtonAdd();
            });
        });
    </script>
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

