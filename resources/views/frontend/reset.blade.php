<!doctype>
<html>
@include('frontend.partials.html_header')
<body>
<div class="container">
    @include('frontend.partials.header')
    <div class="login-box">
        <div class="login-logo">
            <a href="/"> <img src="/images/logo.png"/></a>
        </div>
        <div class="login-box-body">
            @include('frontend.validation.all')
            {!! Form::open(['route'=>'reset.post']) !!}
            <div class="form-group has-feedback">
                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password','required'=>'required','data-toggle'=>"popover", 'title'=>"Password Rules", 'data-content'=>"&middot;8&nbsp;characters \n &middot;special&nbsp;characters\n &middot;numbers \n &middot;letters \n &middot;change&nbsp;in&nbsp;case"]) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Confirm Password','required'=>'required']) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">

                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
                </div>
            </div>
            {{Form::hidden('user_id',$user->id)}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@include('frontend.partials.footer')
</body>
</html>