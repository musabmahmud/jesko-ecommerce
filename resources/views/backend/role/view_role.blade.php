@extends('backend.master')
@section('role')
    opened
@endsection
@can('assign user')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3>role</h3>
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
                                <table id="myTable" class="display table table-striped table-bordered dataTable"
                                    width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Permissions</th>
                                            <th>Action</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $key => $role)
                                            <tr role="row">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    <ul>
                                                        @foreach ($role->permissions as $permission)
                                                            <li>{{$permission->name}}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td><a href="{{ route('role.edit', $role->id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                <td>
                                                    <form method="POST"
                                                        action="{{ route('role.destroy', ['role' => $role->id]) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $role->id }}">
                                                        <button type="submit"
                                                            class="btn btn-xs btn-danger btn-flat show_confirm"
                                                            data-toggle="tooltip" title='Delete'>Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

@else
<div class="page-content">
    <div class="container-fluid">
        <div class="section-header">
            <div class="alert alert-warning">You Don't Have Permissions To Access This</div>
        </div>
    </div>
</div>
@endcan