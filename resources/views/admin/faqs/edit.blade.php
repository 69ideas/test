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
    {!! Form::model($faq, ['route'=>['admin.faq.update', $faq], 'method'=>'PATCH']) !!}

    @include('admin.faqs._form')

    {!! Form::close() !!}
@stop