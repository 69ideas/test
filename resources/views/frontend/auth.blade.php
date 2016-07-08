<!doctype>
<html>
@include('frontend.partials.html_header')
<body>
<div class="container">
    @include('frontend.partials.header')
    <div class="login-box">
        <div class="login-logo">
            <a href="/">Vault-X. Login</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            @include('frontend.validation.all')
            {!! Form::open(['route'=>'login.post']) !!}
            <div class="form-group has-feedback">
                {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email']) !!}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember-me"> Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign in</button>
                    <!--a href="#"><i class="fa fa-facebook-official"></i></a-->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <a href="/register">Registration</a> <br>
                    <a href="{{route('forgot')}}">Forgot password</a>
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