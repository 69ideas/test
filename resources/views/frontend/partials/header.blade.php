<div class="row">
    <div class="col-md-4 col-sm-3 col-xs-12">
        <div class="logo">
            <img src="images/logo.png"/>
        </div>
    </div>
    <div class="col-md-8 col-sm-9 col-xs-12">
        <nav>
            <ul class="text-right list-inline">
                <li><a href="#">Simple </a></li>
                <li><a href="#">Transparent </a></li>
                <li><a href="#">Secure</a></li>
                <li><a href="#">Who </a></li>
                <li class="active"> @if (!\Auth::user()) <a href="/login">Login/Register</a>@endif</li>
                <li><a href="#">Find  an Event </a></li>
                @if (\Auth::user())
                    <li><a href="/logout">Logout</a></li>
                    <li><a href="/profile">Profile</a></li>
                    <li><a href="/event">Events</a></li>
                @endif
            </ul>
            <div class="bars text-right">
                <i class="fa fa-bars"></i>
            </div>
        </nav>
    </div>
</div>