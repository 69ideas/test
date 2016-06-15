@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            @include('admin.validation.all')
        </div>
    </div>

    <div class="row">
        &nbsp;
    </div>
    {!! Form::open(['route'=>['admin.page.store'], 'files' => true]) !!}

    @include('admin.pages._form')

    {!! Form::close() !!}
@stop