@extends('frontend.layout')
@section('content')
    <h2>{{$page->title}}</h2>
    <hr style="border: none; /* Убираем границу */
    background-color: #bb0000; /* Цвет линии */
    color: #bb0000; /* Цвет линии для IE6-7 */
    height: 5px;">
    <hr style="border: none; /* Убираем границу */
    background-color: #bb0000; /* Цвет линии */
    color: #bb0000; /* Цвет линии для IE6-7 */
    height: 5px;">
    {!! $page->content !!}
@endsection