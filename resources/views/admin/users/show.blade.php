@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            @include('admin.validation.all')
        </div>
    </div>

    <div class="row">
        &nbsp;
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="col-md-6"><h3 class="box-title">Member Data</h3></div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <p class="form-control-static">{{$user->first_name}}</p>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <p class="form-control-static">{{$user->last_name}}</p>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <p class="form-control-static">{{$user->username}}</p>
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <p class="form-control-static">{{$user->email}}</p>
                            </div>
                            <div class="form-group">
                                <label>Zip Code</label>
                                <p class="form-control-static">{{$user->zip_code}}</p>
                            </div>
                            <div class="form-group">
                                Bank Account Verified @if( $user->bank_account_verified)  <i
                                        class="fa fa-check"></i> @else <i class="fa fa-close"></i>@endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <p class="form-control-static">{{$user->phone}}</p>
                            </div>
                            <div class="form-group">
                                <label>Address 1</label>
                                <p class="form-control-static">{{$user->address_1}}</p>
                            </div>
                            <div class="form-group">
                                <label>Address 2</label>
                                <p class="form-control-static">{{$user->address_2}}</p>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <p class="form-control-static">{{$user->city}}</p>
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <p class="form-control-static">{{$user->state}}</p>
                            </div>

                            <div class="form-group">
                                Is Admin? @if( $user->is_admin )  <i class="fa fa-check"></i> @else <i
                                        class="fa fa-close"></i>@endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('admin.user.edit',$user) }}" class="btn btn-primary"><i
                                class="fa fa-pencil"></i>
                        Edit
                    </a>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-primary"><i
                                class="fa fa-angle-double-left"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>


@endsection