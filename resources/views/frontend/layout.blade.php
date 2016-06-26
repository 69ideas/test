<!doctype>
<html>
@include('frontend.partials.html_header')
<body>
<div class="container">
    @include('frontend.partials.header')
    @yield('content')
    @include('frontend.partials.bottom_part')
</div>
@include('frontend.partials.footer')

</body>
</html>