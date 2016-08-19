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
    {!! Form::model($event, ['route'=>['event.update', $event], 'method'=>'PATCH']) !!}
    @include('frontend.events._form')
    {!! Form::close() !!}
@stop