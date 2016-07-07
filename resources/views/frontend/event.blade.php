@extends('frontend.layout')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>{{$event->short_description}}</h3>
            <h4 style="text-align: right">Coordinator: {{$event->user->full_name}} </h4>
            <h5 style="text-align: right">Coordinar's Email:   {{$event->user->email}}</h5>
            <hr>
            <div class="form-group">
                {!! $event->description !!}
                <hr>
                Amount per Participant
                {{ number_format($event->needable_sum, 2) }}<br>
                Total Collected
                {{ number_format($event->total, 2) }}
            </div>
        </div>
        <div class="col-md-6">
            @if(!empty($event->image))
                <img src="/{{$event->image}}" style="width: 100%"/>
            @else
                <img src="/images/no-image.png" style="width: 100%"/>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">

            @if($prev != null)
                <a href="{{route('show.event',[$prev])}}">Previous</a>
            @endif
        </div>

        <div class="col-xs-4" style="text-align: center">
            @if(!$event->allow_anonymous && \Auth::user() || $event->allow_anonymous)
            <a href="{{route('payment',[$event])}}" class="make-payment">Make Payment</a>
            @else
                <a href="{{route('login')}}">Please Sign in to do payment</a>
            @endif
        </div>

        <div class="col-xs-4" style="text-align: right">
            @if($next!= null)
                <a href="{{route('show.event',[$next])}}">Next</a>
            @endif
        </div>
    </div>
@endsection