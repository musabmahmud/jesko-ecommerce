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
                                <li>galleries</li>
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
                                <a href="{{route('galleryCreate',$product->id)}}" class="btn btn-inline btn-success m-b">Added New</a>
                                <table id="myTable" class="table table-striped table-responsive table-bordered dataTable" style="width: 100%">
                                    <thead>
                                        <tr role="row">
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
                                                <td><img src="{{asset('galleries')}}/{{$gallery->gallery_name}}" height="100" width="100" alt="{{ $product->product_name }}"/></td>
                                                <td><a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-warning m-b-md">Edit</a>
                                                <form method="POST"
                                                    action="{{ route('gallery.destroy', ['gallery' => $gallery->id]) }}">
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
                                {{ $galleries->links() }}
                            </div>
                            <a href="{{route('product.index')}}" class="btn btn-primary m-l">Back</a>
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
