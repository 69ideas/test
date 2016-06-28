<!doctype>
<html>
@include('frontend.partials.html_header')
<body>
<div class="container">
    @include('frontend.partials.header')
    <div class="login-box">
        <div class="login-logo">
            <a href="#">Vault-X. Register</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            @include('frontend.validation.all')
            {!! Form::open(['route'=>'register.post']) !!}
            <div class="form-group has-feedback">
                {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email','required'=>'required']) !!}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password','required'=>'required']) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Confirm Password','required'=>'required']) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <a href="/login">I've already had account</a>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class=" btn btn-primary btn-block btn-flat" style="background: #49658A;">Sign up</button>
                    <!--a href="#"><i class="fa fa-facebook-official"></i></a-->
                </div>
            </div>
            {!! Form::close() !!}

        </div>
        <!-- /.login-box-body -->
    </div>
</div>
@include('frontend.partials.footer')

</body>
</html>