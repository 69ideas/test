<!doctype>
<html>
@include('frontend.partials.html_header')
<body>
<div class="container">
    @include('frontend.partials.header')
    <div class="login-box">
        <div class="login-logo">
            <a href="/"> <img  src="/images/logo.png"/></a>
        </div>
        <div class="login-box-body">
            @include('frontend.validation.all')
            {!! Form::open(['route'=>'forgot.post']) !!}
            <div class="form-group has-feedback">
                {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email']) !!}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">

                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@include('frontend.partials.footer')
</body>
</html>