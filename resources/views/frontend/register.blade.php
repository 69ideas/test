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
                <div class="row" style="padding: 2% 0 10%;">
                    <div class="col-lg-3 col-lg-offset-1 col-md-4 visible-md visible-lg" style="padding-top: 15%;">
                        <h3 align="center">Registration Steps</h3>
                        <p>
                        <ol style="list-style-type:decimal;">
                            <li style="background-color: #feff00">Enter your email address and create a password</li>
                            <li>Activate your account by checking your email for an activation email</li>
                            <li>Fill out the profile information</li>
                        </ol>
                        </p>
                        <a href="#" style="font-size: 10px;">Click here to see sample profile information</a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group" align="center">
                            <h3>Registration Step 1</h3>
                        </div>
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
                                    <button type="submit" class=" btn btn-primary btn-block btn-flat"
                                            style="background: #49658A;">Sign up
                                    </button>
                                    <!--a href="#"><i class="fa fa-facebook-official"></i></a-->
                                </div>
                            </div>

                            {!! Form::close() !!}

                        </div><!-- /.login-box-body -->
                    </div>
                    <div class="col-lg-4 visible-lg" style="padding-top: 20%;">
                        <h3 align="center">Password must contain</h3>
                        <ol style="list-style-type: decimal;">
                            <li>Contains 8+ characters</li>
                            <li>Upper and lowercase</li>
                            <li>At least 1 number</li>
                            <li>At least 1 special character (#,$,%,&, …)</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.partials.footer')
</div>
</body>
</html>