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
                            <li class="active">Create Role</li>
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
            <form action="{{route('role.store')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="form-control-label"><h2>Role</h2></label>
                    </div>
                    <div class="col-md-10">
                        <p class="form-control-static">
                            <input type="text" class="form-control" id="role_name" placeholder="Enter role Name" value="{{old('role_name')}}" name="role_name">
                        </p>
                        <p>
                            @error('role_name')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-12">
                        <label class="form-control-label"><h2>Permissions:</h2></label>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-md-3">
                                    <div class="checkbox-bird green">
                                        <input type="checkbox" id="{{ $permission->id }}" value="{{ $permission->name }}" name="permissions[]">
                                        <label for="{{ $permission->id }}">{{$permission->name}}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <p>
                            @error('permissions')
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

