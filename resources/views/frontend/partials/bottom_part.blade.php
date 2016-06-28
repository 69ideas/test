<div class="row">
    &nbsp;
</div>
<div class="row">
            @foreach($bottom_pages as $bottom_page)
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="text-center sec_mid">
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
            </div>
        </div>
            @endforeach

</div>
