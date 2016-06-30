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
    {!! Form::model($photo, ['route'=>['admin.photo.update', $photo], 'method'=>'PATCH', 'files' => true]) !!}
    @include('admin.photos._form')
    {!! Form::close() !!}
@stop