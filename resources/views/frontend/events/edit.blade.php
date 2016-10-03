@extends('frontend.layout')

@section('content')

    @if($event->isCoordinator(\Auth::user()) && $event->CountFees()>0)
        <div class="alert alert-danger">
            Your outstanding balance is ${{$event->CountFees()}}. <a href="{{route('pay_fee', $event)}}">Pay
                now.</a>
        </div>
        @else
        <div class="alert alert-success">
            Your outstanding balance is clear.</a>
        </div>

    @endif
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <div class="col-sm-12">
            @include('admin.validation.all')
        </div>
    </div>

    <div class="row">
        &nbsp;
    </div>
    {!! Form::model($event, ['route'=>['event.update', $event], 'method'=>'PATCH']) !!}
    @include('frontend.events._form')
    {!! Form::close() !!}
@stop