@extends('backend.master')
@section('role')
opened
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="section-header">
            <div class="tbl">
                <div class="tbl-row">
                    <div class="tbl-cell">
                        <h3>role</h3>
                        <ol class="breadcrumb breadcrumb-simple">
                            <li class="active">Create User Role</li>
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
            <form action="{{route('assignUserStore')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="form-control-label"><h2>User</h2></label>
                    </div>
                    <div class="col-md-10">
                        <p class="form-control-static">
                            <select name="user" id="user" class="form-control @error('user') is-invalid @enderror">
                                <option value="">--Select User--</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </p>
                        <p>
                            @error('user')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label"><h2>Role</h2></label>
                    </div>
                    <div class="col-md-10">
                        <p class="form-control-static">
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="">--Select Role--</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </p>
                        <p>
                            @error('role')
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

