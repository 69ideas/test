@extends('frontend.layout')
@section('content')

    @foreach($faqs as $faq)
        <div class="form-group">
            <h4>{{$faq->question}}</h4>
            {{$faq->answer}}
            <hr>
        </div>
    @endforeach
@endsection