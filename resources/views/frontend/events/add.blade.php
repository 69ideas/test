@extends('frontend.index')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            @include('admin.validation.all')
        </div>
    </div>

    <div class="row">
        &nbsp;
    </div>
    {!! Form::open(['route'=>['event.store'], 'files' => true]) !!}

    @include('frontend.events._form')

    {!! Form::close() !!}
@stop