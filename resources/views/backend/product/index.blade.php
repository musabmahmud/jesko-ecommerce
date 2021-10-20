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
                                <table id="myTable" class="display table table-striped table-responsive table-bordered dataTable"
                                    width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th></th>
                                            <th>Products Name</th>
                                            <th>Cat</th>
                                            <th>Brand</th>
                                            <th>Type</th>
                                            <th>Weight</th>
                                            <th>Thumb</th>
                                            <th>Materials</th>
                                            <th>Short</th>
                                            <th>Summary</th>
                                            <th>Descrip</th>
                                            <th>Created</th>
                                            <th>View</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr role="row">
                                                <td>{{ $products->firstItem() + $key }}</td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->category->category_name }}</td>
                                                <td>{{ $product->brand->brand_name }}</td>
                                                <td>{{ $product->type_name }}</td>
                                                <td>{{ $product->weight }}g</td>
                                                <td><img src="products/{{$product->thumbnail}}" height="100" width="100" alt="{{ $product->product_name }}"/></td>
                                                <td>{{ $product->materials }}</td>
                                                <td>{{ $product->short_info }}</td>
                                                <td>{{Str::limit($product->summary, 50, $end='.......')}}</td>
                                                <td>{{Str::limit($product->description, 50, $end='.......')}}</td>
                                                <td>{{ $product->created_at->format('d-M-Y h:i:s a')}} ({{$product->created_at->diffForHumans()}})</td>
                                                <td>
                                                    <a href="{{ route('attributeIndex', $product->id) }}"
                                                    class="btn btn-primary m-b">Attribute</a>
                                                    <a href="{{ route('galleryIndex', $product->id) }}"
                                                        class="btn btn-primary">Gallery</a>
                                                </td>
                                                <td><a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning m-b-md">Edit</a>
                                                <form method="POST"
                                                    action="{{ route('product.destroy', ['product' => $product->id]) }}">
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
                                {{ $products->links() }}
                            </div>
                        </div>
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
