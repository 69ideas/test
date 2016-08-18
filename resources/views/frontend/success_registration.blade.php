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
                <div class="col-lg-3 col-lg-offset-1 col-md-4 visible-md visible-lg" style="padding-top: 15%;">
                    <h3 align="center">Registration Steps</h3>
                    <p>
                    <ol style="list-style-type:decimal;">
                        <li>Enter your email address and create a password</li>
                        <li style="background-color: #feff00">Activate your account by checking your email for an activation email</li>
                        <li>Fill out the profile information</li>
                    </ol>
                    </p>
                    <a href="#" style="font-size: 10px;">Click here to see sample profile information</a>
                </div>
                <div class="login-box">
                    <div class="login-logo">
                        <h2>Registration step 2</h2>
                    </div>
                    <!-- /.login-logo -->
                    <div class="login-box-body" align="center">
                        <p>Thank you for completing Step 1 of the registration.</p>
                        <p>{{ $email }}</p>
                        <p>Please check your email for the activation link</p>
                        <br>
                        @if (!$isResend)
                        {!! Form::open(['route'=>['resend_the_link']] ) !!}
                        {!! Form::hidden('email', $email) !!}
                        <button type="submit">Click here to resend the link</button>
                        {!! Form::close() !!}
                        @else
                            <p>Link was send.</p>
                        @endif
                        <div class="row">
                            &nbsp;
                        </div>
                    </div>
                    <!-- /.login-box-body -->
                </div>
            </div>
            <div class="row">
                &nbsp;
            </div>
            <div class="row">
                &nbsp;
            </div>
            <div class="row">
                &nbsp;
            </div>
            <div class="row">
                &nbsp;
            </div>
        </div>
    </div>
    @include('frontend.partials.footer')
</div>
</body>
</html>
