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
    {!! Form::open(['route'=>['event.store']]) !!}
    @include('frontend.events._form')
    <div class="row">
        &nbsp;
    </div>
    {!! Form::close() !!}
@stop