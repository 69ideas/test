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
        @foreach($events as $event)
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="in_img">
                <img src="{{$event->image}}"/>
                <div class="desc"><a href="{{route('show.event',$event)}}" style="color: black; font-family: MyriadPro-Bold;"> {{$event->title}}</a></div>
            </div>
        </div>
        @endforeach
    </div>
@endsection