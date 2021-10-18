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
            <form action="{{route('product.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="form-control-label">Product Name *</label>
                        <p class="form-control-static">
                            <input type="text" class="form-control @error('product_name') is invalid @enderror" id="product_name" placeholder="Enter Product Name" value="{{old('product_name')}}" name="product_name" required>
                        </p>
                        <p>
                            @error('product_name')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Category *</label>
                        <select class="select2-arrow @error('category_id') is invalid @enderror" value="{{old('category_id')}}" name="category_id" required>
                            <option value="">Choose Category</option>
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
                        <select class="select2-arrow @error('brand_id') is invalid @enderror" value="{{old('brand_id')}}" name="brand_id" required>
                            <option value="">Choose Brand</option>
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
                        <select class="select2-arrow @error('type_name') is invalid @enderror" value="{{old('type_name')}}" name="type_name">
                            <option value="">Choose Type</option>
                            <option value="men">Men</option>
                            <option value="women">Women</option>
                            <option value="kids">Kids</option>
                        </select>
                        <p>
                            @error('type_name')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Product Weight</label>
                        <p class="form-control-static">
                            <input type="number" min="0" class="form-control @error('description') is invalid @enderror" id="product_name" placeholder="Enter product Weight(g)" value="{{old('weight')}}" name="weight">
                        </p>
                        <p>
                            @error('weight')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Thumbnail *</label>
                        <p class="form-control-static">
                            <input type="file" class="form-control @error('thumbnail') is invalid @enderror" id="thumbnail" name="thumbnail" onchange="document.getElementById('image_id').src= window.URL.createObjectURL(this.files[0])">
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
                            <input type="file" multiple class="form-control @error('gallery') is invalid @enderror" id="gallery" name="gallery[]">
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
                                    <label class="form-control-label">Color *</label>
                                    <select class="select2-arrow @error('color') is invalid @enderror" value="{{old('color')}}" name="color[]" required>
                                        <option value="">Choose Color</option>
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
                                <div class="col-md-3">
                                    <label class="form-control-label">Size *</label>
                                    <select class="select2-arrow @error('size') is invalid @enderror" value="{{old('size')}}" name="size[]" required>
                                        <option value="">Choose Size</option>
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
                                    <label class="form-control-label">Quantity *</label>
                                    <p class="form-control-static">
                                        <input type="number" min="0" class="form-control @error('quantity') is invalid @enderror" id="quantity" placeholder="Quantity" value="{{old('quantity')}}" name="quantity[]" required>
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
                                        <input type="number" min="0" class="form-control @error('price') is invalid @enderror" id="price" placeholder="Price" value="{{old('price')}}" name="price[]" required>
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
                                        <input type="number" min="0" class="form-control @error('offer_price') is invalid @enderror" id="offer_price" placeholder="Offer Price" value="{{old('offer_price')}}" name="offer_price[]">
                                    </p>
                                    <p>
                                        @error('offer_price')
                                            <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                                        @enderror
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
                            <input type="text" class="form-control @error('materials') is invalid @enderror" id="materials" placeholder="Enter Product Meterials" value="{{old('materials')}}" name="materials">
                        </p>
                        <p>
                            @error('materials')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Product Short Information</label>
                        <p class="form-control-static">
                            <input type="text" class="form-control @error('short_info') is invalid @enderror" id="short_info" placeholder="One Sentence Information" value="{{old('short_info')}}" name="short_info">
                        </p>
                        <p>
                            @error('short_info')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Summary *</label>
                        <p class="form-control-static">
                            <textarea class="form-control @error('summary') is invalid @enderror"  name="summary" id="summary" placeholder="Enter Summary Shortly" cols="30" rows="10" required>{{old('summary')}}</textarea>
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
                            <textarea class="form-control @error('description') is invalid @enderror"  name="description" id="description" placeholder="Enter Description Briefly" cols="30" rows="10" required>{{old('description')}}</textarea>
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
            var maxFields = 50;

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
