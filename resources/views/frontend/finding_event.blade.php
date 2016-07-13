@extends('frontend.layout')
@section('content')
    {!! Form::open(['route'=>'find.post']) !!}
    <div class="row">
        @include('frontend.validation.all')
        <div class="form-group">
            <label>Event Number </label>
            {!! Form::text('event_number', null, ['class'=>'form-control', 'placeholder'=>'Event Number ']) !!}
        </div>
        <div class="form-group">
            <label>Event Access Code</label>
            {!! Form::text('event_code', null, ['class'=>'form-control', 'placeholder'=>'Event Access Code ']) !!}
        </div>
        <div class="row">
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat" style="background: #49658A;">Find Event</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection