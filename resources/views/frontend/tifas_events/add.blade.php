@extends('frontend.layout')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            @include('admin.validation.all')
        </div>
    </div>

    <div class="row">
        &nbsp;
    </div>
    {!! Form::open(['route'=>['tifas_event.store'], 'files' => true]) !!}

    @include('frontend.tifas_events._form')
    <div class="row">
        &nbsp;
    </div>
    {!! Form::close() !!}
@stop