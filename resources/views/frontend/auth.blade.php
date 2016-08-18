<!doctype>
<html>
@include('frontend.partials.html_header')
<body class="home page page-id-40 page-template-default custom-background
et_pb_button_helper_class et_fixed_nav et_show_nav et_secondary_nav_enabled
et_pb_gutter windows et_pb_gutters3 et_primary_nav_dropdown_animation_fade
et_secondary_nav_dropdown_animation_fade et_pb_footer_columns4 et_header_style_left
et_pb_pagebuilder_layout et_right_sidebar chrome">
<div id="page-container" style="padding-top: 123px;">
    @include('frontend.partials.header')
    <div id="et-main-area">
        <div id="main-content">
            <div class="container">
                <div class="login-box">
                    <div class="login-logo">
                        <a href="/"> <img src="/images/logo.png"/></a>
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
                            <div class="col-xs-6">
                                <a href="/register">Registration</a>
                            </div>
                            <div class="col-xs-6" style="text-align: right">
                                <a href="{{route('forgot')}}">Forgot password</a>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                    <!-- /.login-box-body -->
                </div>
            </div>
        </div>
    </div>
    @include('frontend.partials.footer')
</div>
</body>
</html>