@if(!\Auth::user())
    <div class="row">
        <div class="col-md-12">
            <div class="et_pb_button_module_wrapper et_pb_button_alignment_center">
                <a class="et_pb_button et_pb_custom_button_icon  et_pb_button_0" href="{{route('login')}}">
                    GET STARTED!
                    <i class="fa fa-play-circle-o" style="font-size: 20px;"></i>
                </a>
            </div>
        </div>
    </div>
@endif
<div class="row">
    &nbsp;
</div>
<div class="row et_pb_padd">
    @foreach($bottom_pages as $bottom_page)
        @if(count($bottom_page->pages))
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="et_pb_button_module_wrapper et_pb_module et_pb_button_alignment_center">
                    <a class="et_pb_button et_pb_button_1 et_pb_module et_pb_bg_layout_light"
                       href="{{route ('page',$bottom_page->seo_url)}}">{{$bottom_page->menu_name}}</a>
                    <ul>
                        @foreach($bottom_page->pages as $child)
                            <li><a href="{{route ('page',$child->seo_url)}}" class="not_a">{{$child->menu_name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @elseif($bottom_page->parent_id==null and !(count($bottom_page->pages)))
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="et_pb_button_module_wrapper et_pb_module et_pb_button_alignment_center">
                    <a class="et_pb_button et_pb_button_1 et_pb_module et_pb_bg_layout_light"
                       href="{{route ('page',$bottom_page->seo_url)}}">{{$bottom_page->menu_name}}</a>
                    <p>{{$bottom_page->brief}}</p>
                </div>
            </div>
        @endif
    @endforeach
</div>
