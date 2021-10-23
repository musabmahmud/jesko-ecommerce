@extends('backend.master')
@section('color')
    opened
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3>color</h3>
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
                                        @foreach ($colors as $key => $color)
                                            <tr role="row">
                                                <td>{{$colors->firstItem() + $key}}</td>
                                                <td>{{$color->color_name}}</td>
                                                <td><a href="{{ route('colorrecovery',$color->id) }}" class="btn btn-secondary">Restore</a>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $colors->links() }}
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
