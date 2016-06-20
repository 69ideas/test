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
    {!! Form::model($article, ['route'=>['admin.article.update', $article], 'method'=>'PATCH', 'files' => true]) !!}

    @include('admin.article._form')

    {!! Form::close() !!}
@stop