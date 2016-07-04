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
    {!! Form::model($event, ['route'=>['tifas_event.update', $event], 'method'=>'PATCH', 'files' => true]) !!}
    @include('frontend.tifas_event._form')
    {!! Form::close() !!}
@stop