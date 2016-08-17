<!doctype>
<html>
@include('frontend.partials.html_header')
<body class="home page page-id-40 page-template-default custom-background et_pb_button_helper_class
et_fixed_nav et_show_nav et_secondary_nav_enabled et_pb_gutter windows et_pb_gutters3
et_primary_nav_dropdown_animation_fade et_secondary_nav_dropdown_animation_fade et_pb_footer_columns4
et_header_style_left et_pb_pagebuilder_layout et_right_sidebar chrome">
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
                        {!! Form::open(['route'=>'register.post']) !!}
                        <div class="form-group has-feedback">
                            {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email','required'=>'required']) !!}
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password','required'=>'required','data-toggle'=>"popover", 'title'=>"Password Rules", 'data-content'=>"&middot;8&nbsp;characters \n &middot;special&nbsp;characters\n &middot;numbers \n &middot;letters \n &middot;change&nbsp;in&nbsp;case"]) !!}
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
                                <button type="submit" class=" btn btn-primary btn-block btn-flat"
                                        style="background: #49658A;">Sign up
                                </button>
                                <!--a href="#"><i class="fa fa-facebook-official"></i></a-->
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