<!DOCTYPE html>
<html>
<head>
    <title>Vault-X</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    @include('admin.partials.html_head')
</head>
<body>
<div class="container">
    <div class="content">
        <a href="/">Simple</a>
        <a href="/">Transparent</a>
        <a href="/">Secure</a>
        <a href="/">Who</a>
        @if (!\Auth::user()) <a href="/login">Login/Register</a>@endif
        <a href="/">Find Event</a>
        @if (\Auth::user())
            <a href="/logout">Logout</a>
            <a href="/profile">Profile</a>
            <a href="/event">Events</a>
        @endif
        @yield('content')
    </div>
</div>
</body>
@include('admin.partials.html_scripts')
</html>
