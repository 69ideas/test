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
    {!! Form::model($user, ['route'=>['admin.user.update', $user], 'method'=>'PATCH', 'files' => true]) !!}
    @include('admin.users._form')
    {!! Form::close() !!}
@stop