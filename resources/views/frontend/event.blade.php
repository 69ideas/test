@extends('frontend.layout')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>{{$event->title}}</h3>
            <hr>
            <div class="form-group">
                {!! $event->description !!}
            </div>
        </div>
        <div class="col-md-6">
            <img src="/{{$event->image}}" style="width: 100%"/>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">

            @if($prev != null)
                <a href="{{route('show.event',[$prev])}}">Previous</a>
            @endif
        </div>

        <div class="col-sm-4" style="text-align: center">

            <a href="{{route('show.event',[$next])}}">Make Payment</a>
        </div>

        <div class="col-sm-4" style="text-align: right">
            @if($next!= null)
                <a href="{{route('show.event',[$next])}}">Next</a>
            @endif
        </div>
    </div>
@endsection