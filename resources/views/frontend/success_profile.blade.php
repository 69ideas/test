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
                        <h2>Successfully filled profile</h2>
                    </div>
                    <!-- /.login-logo -->
                    <div class="login-box-body" align="center">
                        <p>You successfully filled your profile</p>
                        <p>Now you can create events</p>
                        <br>
                        <div class="row">
                            &nbsp;<a href="{{route('event.index')}}" class="btn btn-block btn-primary">Start!</a>
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
