@extends('backend.master')
@section('brand')
    opened
@endsection
@can('brand trash')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3>brand</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li class="active">Trashed</li>
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
                                <table id="myTable" class="display table table-striped table-bordered dataTable"width="100%" role="grid" aria-describedby="example_info"
                                    style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $key => $brand)
                                            <tr role="row">
                                                <td>{{$brands->firstItem() + $key}}</td>
                                                <td>{{$brand->brand_name}}</td>
                                                <td><a href="{{ route('brandrecovery',$brand->id) }}" class="btn btn-secondary">Restore</a>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $brands->links() }}
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

@else
<div class="page-content">
    <div class="container-fluid">
        <div class="section-header">
            <div class="alert alert-warning">You Don't Have Allow To Access This</div>
        </div>
    </div>
</div>
@endcan
