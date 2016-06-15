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
    {!! Form::model($page, ['route'=>['admin.page.update', $page], 'method'=>'PATCH', 'files' => true]) !!}
    @include('admin.pages._form')
    {!! Form::close() !!}
@stop