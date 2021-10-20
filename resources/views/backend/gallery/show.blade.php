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
                            <h3>product</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li>Attributes and Gallery</li>
                                <li class="active">View</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <section class="card">
                    <div class="card-block">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{route('product.index')}}" class="btn btn-inline btn-success m-b">Added New</a>

                                <table id="myTable" class="table table-striped table-responsive table-bordered dataTable" style="width: 100%">
                                    <thead>
                                        <tr role="row">
                                            <th>No</th>
                                            <th>Products Name</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Offer Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attrs as $key => $attr)
                                            <tr role="row">
                                                <td>{{ $attrs->firstItem() + $key }}</td>
                                                <td>{{ $product->product_name}}</td>
                                                <td>{{ $attr->color}}</td>
                                                <td>{{ $attr->size }}</td>
                                                <td>{{ $attr->quantity }}</td>
                                                <td>{{ $attr->price }}</td>
                                                <td>{{ $attr->offer_price }}</td>
                                                {{-- <td><img src="products/{{$product->thumbnail}}" height="100" width="100" alt="{{ $product->product_name }}"/></td> --}}
                                                <td><a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning m-b-md">Edit</a>
                                                {{-- <a href="{{ route('attrdelete', $attr->id) }}" class="btn btn-warning m-b-md">Delete</a> --}}
                                                <form method="POST"
                                                    action="{{ route('attribute.destroy', ['attribute' => $attr->id]) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                                    <button type="submit"
                                                        class="btn btn-xs btn-danger btn-flat show_confirm"
                                                        data-toggle="tooltip" title='Delete'>Delete</button>
                                                </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $attrs->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{route('product.index')}}" class="btn btn-inline btn-success m-b">Added New</a>
                                <table class="table table-striped table-responsive table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Products Name</th>
                                            <th>Gallery Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($galleries as $key => $gallery)
                                            <tr>
                                                <td>{{ $galleries->firstItem() + $key }}</td>
                                                <td>{{ $product->product_name}}</td>
                                                <td><img src="{{ asset('products')}}/{{$gallery->gallery_name}}" height="200" width="200" alt="{{ $product->product_name }}"/></td>
                                                <td>
                                                    {{-- <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning m-b-md">Edit</a> --}}
                                                {{-- <form method="POST"
                                                    action="{{ route('product.destroy', ['product' => $product->id]) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                                    <button type="submit"
                                                        class="btn btn-xs btn-danger btn-flat show_confirm"
                                                        data-toggle="tooltip" title='Delete'>Delete</button>
                                                </form> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $galleries->links() }}
                            </div>
                        </div>
                        <a href="{{route('product.index')}}" class="btn btn-inline btn-primary btn-lg m-t">Back</a>
                    </div>
                </section>
            </div>
            {{-- <div class="row">
            <div class="col-md-12">
                
            </div><!--.col-->
        </div><!--.row--> --}}
        </div>
        <!--.container-fluid-->
    </div>
    <!--.page-content-->
@endsection

@section('footer_js')
    <script>
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
