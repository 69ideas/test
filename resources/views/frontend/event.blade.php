@extends('frontend.layout')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>{{$event->short_description}}</h3>
            <hr>
            <div class="form-group">
                {!! $event->description !!}
            </div>
        </div>
        <div class="col-md-6">
            @if(!empty($event->image))
                <img src="{{$event->image}}" style="width: 100%"/>
            @else
                <img src="/images/no-image.png" style="width: 100%"/>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">

            @if($prev != null)
                <a href="{{route('show.event',[$prev])}}">Previous</a>
            @endif
        </div>

        <div class="col-sm-4" style="text-align: center">
            <a href="{{route('send.email',$event)}}" class="send-email">Send it by email</a>
        </div>

        <div class="col-sm-4" style="text-align: right">
            @if($next!= null)
                <a href="{{route('show.event',[$next])}}">Next</a>
            @endif
        </div>
    </div>
@endsection