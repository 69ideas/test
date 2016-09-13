@extends('frontend.layout')

@section('content')
    <section class="content">
        @include('frontend.validation.all')
        <div class="row">
            <div class="col-sm-12">
                <div class="box-body">
                    <div class="row form-group" align="center">
                        <h2>Member profile page</h2>
                        <hr style="border: none; /* Убираем границу */
    background-color: #bb0000; /* Цвет линии */
    color: #bb0000; /* Цвет линии для IE6-7 */
    height: 5px;">
                    </div>
                    {!! Form::model($user, ['route'=>['profile.post'], 'method'=>'PATCH']) !!}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter First Name"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::text('first_name', null, ['class'=>'form-control', 'placeholder'=>'Enter First Name']) !!}
                        </div>
                        <div class="form-group">
                            <label>Last Name
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter Last Name"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>'Enter Last Name']) !!}
                        </div>
                        <div class="form-group">
                            <label>Username
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter Username"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::text('username', null, ['class'=>'form-control', 'placeholder'=>'Enter Username']) !!}
                        </div>
                        <div class="form-group">
                            <label>E-mail
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter E-mail"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Enter e-mail']) !!}
                        </div>
                        <div class="form-group">
                            <label>Password
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter password"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::password('password', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>Confirm Password
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter password again"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter Phone"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::text('phone', null, ['class'=>'form-control phone', 'placeholder'=>'Enter Phone']) !!}
                        </div>
                        <div class="form-group">
                            <label>Address 1
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter Address"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::text('address_1', null, ['class'=>'form-control', 'placeholder'=>'Enter Address']) !!}
                        </div>
                        <div class="form-group">
                            <label>Address 2
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter Address"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::text('address_2', null, ['class'=>'form-control', 'placeholder'=>'Enter Address']) !!}
                        </div>
                        <div class="form-group">
                            <label>City
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter City"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::text('city', null, ['class'=>'form-control', 'placeholder'=>'Enter City']) !!}
                        </div>
                        <div class="form-group">
                            <label>State
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter State"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::text('state', null, ['class'=>'form-control', 'placeholder'=>'Enter State']) !!}
                        </div>
                        <div class="form-group">
                            <label>Zip Code
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter Zip Code"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::text('zip_code', null, ['class'=>'form-control', 'placeholder'=>'Enter ZipCode']) !!}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-3 col-xs-offset-6">
                            {!! Form::submit('Update profile', ['class'=>'btn btn-primary btn-block','style'=>"background: #49658A;"]) !!}
                            {!! Form::close() !!}
                        </div>
                        <div class="col-xs-3">
                            <a href="{{route('home')}}" class="btn btn-primary btn-block" style="background: #49658A;">Leave without changes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

