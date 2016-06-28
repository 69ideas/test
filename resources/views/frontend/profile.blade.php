@extends('frontend.layout')
@include('frontend.validation.all')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box-body">
                    {!! Form::model($user, ['route'=>['profile.post'], 'method'=>'PATCH']) !!}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name</label>
                            {!! Form::text('first_name', null, ['class'=>'form-control', 'placeholder'=>'Enter First Name']) !!}
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            {!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>'Enter Last Name']) !!}
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            {!! Form::text('username', null, ['class'=>'form-control', 'placeholder'=>'Enter Username']) !!}
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Enter e-mail']) !!}
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            {!! Form::password('password', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone</label>
                            {!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=>'Enter Phone']) !!}
                        </div>
                        <div class="form-group">
                            <label>Address 1</label>
                            {!! Form::text('address_1', null, ['class'=>'form-control', 'placeholder'=>'Enter Address']) !!}
                        </div>
                        <div class="form-group">
                            <label>Address 2</label>
                            {!! Form::text('address_2', null, ['class'=>'form-control', 'placeholder'=>'Enter Address']) !!}
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            {!! Form::text('city', null, ['class'=>'form-control', 'placeholder'=>'Enter City']) !!}
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            {!! Form::text('state', null, ['class'=>'form-control', 'placeholder'=>'Enter State']) !!}
                        </div>
                        <div class="form-group">
                            <label>Zip Code</label>
                            {!! Form::text('zip_code', null, ['class'=>'form-control', 'placeholder'=>'Enter ZipCode']) !!}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! Form::submit('Save', ['class'=>'btn btn-primary','style'=>"background: #49658A;"]) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        </div>
        </div>
    </section>
@endsection

