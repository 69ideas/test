@extends('frontend.layout')
@section('content')
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-sm-offset-1 col-xs-12">
            <div class="sec_top" style="padding-bottom:54px;">
                {!!  $page->content!!}
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($photos as $photo)
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="in_img">
                    @if (!empty($photo->image))
                        <img src="{{$photo->image}}"/>
                    @endif
                    <div class="desc" style="color: black; font-family: MyriadPro-Bold;">{{$photo->name}}</div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('home_what_is')
    <div class="et_pb_section">
        <div class=" et_pb_row">
            <div class="et_pb_column">
                <div class="et_pb_text et_pb_module et_pb_bg_layout_dark et_pb_text_align_center">
                    <h1>What is Vault Xchange?</h1>
                    <p>Vault Xchange is the simplest and easiest way to collect money and track who has paid and who hasn’t. It’s as easy as creating an event, inviting your friends and collecting the money in your Paypal account. No more phone calls and texts to track down money. What could be easier?</p>
                </div>
            </div>
        </div>
    </div>
@endsection