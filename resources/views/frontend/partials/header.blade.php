<div class="row">
    <div class="col-md-2 col-sm-3 col-xs-12">
        <div class="logo">
            <a href="/"> <img  src="/images/logo.png"/></a>
        </div>
    </div>
    <div class="col-md-10 col-sm-9 col-xs-12">
        <nav>
            <ul class="text-right list-inline">
                @foreach($top_pages as $top_page)
                <li><a href="{{route('page',$top_page->seo_url)}}">{{$top_page->menu_name}} </a></li>
                @endforeach
                <li class="{{$active_login or ''}}"> @if (!\Auth::user()) <a href="/login">Login/Register</a>@endif</li>
                <li><a href="#">Find  an Event </a></li>
                @if (\Auth::user())
                    <li><a href="/logout">Logout</a></li>
                    <li class="{{$active_profile or ''}}"><a href="/profile">Profile</a></li>
                    <li class="{{$active_event or ''}}"><a href="/event">My Events</a></li>
                @endif
            </ul>
            <div class="bars text-right">
                <i class="fa fa-bars"></i>
            </div>
        </nav>
    </div>
</div>
<div class="row">
    &nbsp;
</div>