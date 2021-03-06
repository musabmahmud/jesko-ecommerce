@extends('backend.master')
@section('coupon')
opened
@endsection
@can('coupon create')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="section-header">
            <div class="tbl">
                <div class="tbl-row">
                    <div class="tbl-cell">
                        <h3>coupon</h3>
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
            <form action="{{route('coupon.store')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="form-control-label">Coupon Name</label>
                    </div>
                    <div class="col-md-10">
                        <p class="form-control-static">
                            <input type="text" class="form-control" id="coupon_name" placeholder="Enter coupon Name" value="{{old('coupon_name')}}" name="coupon_name">
                        </p>
                        <p>
                            @error('coupon_name')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Amount of Coupons (% value calculated)</label>
                    </div>
                    <div class="col-md-10">
                        <p class="form-control-static">
                            <input type="number" class="form-control" id="coupon_percentage" placeholder="Enter Coupon Value" value="{{old('coupon_percentage')}}" name="coupon_percentage">
                        </p>
                        <p>
                            @error('coupon_percentage')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div>

                    <div class="col-md-2">
                        <label class="form-control-label">Coupon Limit</label>
                    </div>
                    <div class="col-md-10">
                        <p class="form-control-static">
                            <input type="number" class="form-control" id="coupon_limit" placeholder="Enter Numbers of Coupon Users" value="{{old('coupon_limit')}}" name="coupon_limit">
                        </p>
                        <p>
                            @error('coupon_limit')
                                <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                            @enderror
                        </p>
                    </div> 
                    <div class="col-md-2">
                        <label class="form-control-label">Coupon Validity Date</label>
                    </div>
                    <div class="col-md-10">
                        <p class="form-control-static">
                            <input type="date" class="form-control" id="coupon_validity" placeholder="Enter coupon Last Date" value="{{old('coupon_validity')}}" name="coupon_validity">
                        </p>
                        <p>
                            @error('coupon_validity')
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

@else
<div class="page-content">
    <div class="container-fluid">
        <div class="section-header">
            <div class="alert alert-warning">You Don't Have Allow To Access This</div>
        </div>
    </div>
</div>
@endcan

