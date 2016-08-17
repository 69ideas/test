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
            <div class="container" style="margin-top:80px;">
                @yield('content')
                @include('frontend.partials.bottom_part')
            </div>
        </div>
    </div>
    @yield('home_what_is')
    @include('frontend.partials.footer')
</div>
</body>
</html>