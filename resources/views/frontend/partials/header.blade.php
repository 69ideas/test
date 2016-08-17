<div id="waypoint"></div>
<div id="top-header">
    <div class="container-my clearfix">
        <div id="et-secondary-menu">
            <ul class="et-social-icons">
                <li>
                    <a href="#" class="icon">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="icon et-social-icon">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="icon et-social-icon">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="icon et-social-icon">
                        <i class="fa fa-rss"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<header id="main-header">
    <div class="container-my clearfix et_menu_container">
        <div class="logo_container">
            <span class="logo_helper"></span>
            <a href="/">
                <img src="/images/logo.png" alt="Vault Xchange" id="logo">
            </a>
        </div>
        <div id="et-top-navigation" style="padding-left: 225px; height: 66px;">
            <nav id="top-menu-nav">
                <ul id="top-menu">
                    @foreach($top_pages as $top_page)
                        <li @if($page!=null) @if($page->seo_url==$top_page->seo_url) class="active"
                            @endif @endif >
                            <a
                                    href="{{route('page',$top_page->seo_url)}}">{{$top_page->menu_name}} </a></li>
                    @endforeach
                    @if (!\Auth::user())
                        <li class="{{$active_login or ''}}">
                            <a class="get-started" href="/login">Login/Register</a></li>
                    @endif
                    @if (\Auth::user())
                        <li
                        ><a href="/logout">Logout</a></li>
                        <li class="{{$active_event or ''}}"
                        ><a class="get-started" href="/event">@if(\Auth::user()->username)Click
                            for {!! \Auth::user()->username !!} member
                            page @else  {!! \Auth::user()->email !!} @endif</a></li>
                    @endif
                </ul>
                <div class="bars text-right">
                    <i class="fa fa-bars"></i>
                </div>
            </nav>
        </div>
    </div>
</header>