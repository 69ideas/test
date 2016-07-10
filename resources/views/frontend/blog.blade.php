@extends('frontend.layout')
@section('content')
    <h1>{{$page->title}}</h1>
    <hr style="border: none; /* Убираем границу */
    background-color: #bb0000; /* Цвет линии */
    color: #bb0000; /* Цвет линии для IE6-7 */
    height: 5px;">
    @foreach($articles as $article)
        <h2>{{$article->title}}</h2>
        <small class="text-muted">{{$article->created_at->format('m/d/Y')}}</small>
        <hr>
        {!! $article->media_object !!}<br>
        {{ $article->large_annotation }}
        <a href="{{route('show.article',[$article])}}" style="float: right">Read more</a>
        <hr>
        <hr>

     @endforeach
 @endsection