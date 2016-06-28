@extends('frontend.layout')
@section('content')
    <h2>{{$page->title}}</h2>
    <hr>
    {{ $page->content }}
@endsection