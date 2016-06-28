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
        @if($next!= null)
            <a href="{{route('show.event',[$next])}}" style="float: right">Next</a>
        @endif
        @if($prev != null)
            <a href="{{route('show.event',[$prev])}}" style="float: left">Previous</a>
        @endif
    </div>
@endsection