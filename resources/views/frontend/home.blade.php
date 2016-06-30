@extends('frontend.layout')
@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-10 col-sm-oofset-2 col-xs-12">
            <div class="sec_top">
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