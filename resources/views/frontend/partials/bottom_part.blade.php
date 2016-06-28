<div class="row">
    &nbsp;
</div>
<div class="row">
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="text-center sec_mid">
            @foreach($bottom_pages as $bottom_page)
                @if(count($bottom_page->pages))
                    <a href="{{route ('page',$bottom_page->seo_url)}}">{{$bottom_page->menu_name}}</a>
                    <ul>
                    @foreach($bottom_page->pages as $child)
                            <li><a href="{{route ('page',$child->seo_url)}}" class="not_a">{{$child->menu_name}}</a></li>
                    @endforeach
                    </ul>
                @elseif($bottom_page->parent_id==null and !(count($bottom_page->pages)))
                    <a href="{{route ('page',$bottom_page->seo_url)}}">{{$bottom_page->menu_name}}</a>
                    <p>{{$bottom_page->brief}}</p>
                @endif
            @endforeach
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="text-center sec_mid">
            <a href="#">Simple</a>
            <p>See how easy it is to use Take it for a spin without having to register</p>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="text-center sec_mid">
            <a href="#">Transparent</a>
            <ul>
                <li>Fees</li>
                <li>About us</li>
                <li>Mission</li>
                <li>Fees</li>
                <li>Blog</li>
                <li>FAQ</li>
            </ul>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="text-center sec_mid">
            <a href="#">Secure</a>
            <p>The Industry Security Measures Terms & Conditions</p>

        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="text-center sec_mid">
            <a href="#">Who</a>
            <p>See who's using Vaultxit.com</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="text-center start_now">
            <a href="/login">Get Started Now</a>
        </div>
    </div>
</div>
