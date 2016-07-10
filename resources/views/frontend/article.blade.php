@extends('frontend.layout')
@section('content')
    @if (isset($article->media_object))
        <div class="row">
            <div class="col-md-6">
                <h3>{{$article->title}}</h3>
                <small class="text-muted">{{$article->created_at->format('h:m m/d/y')}}</small>
                <hr>
                <div class="form-group">
                    {!! $article->text !!}
                </div>
            </div>
            <div class="col-md-6" id="res">
                {!! $article->media_object!!}
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <h3>{{$article->title}}</h3>
                <small class="text-muted">{{$article->created_at->format('m/d/Y')}}</small>
                <hr>
                <div class="form-group">
                    {!! $article->text !!}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-6">

            @if($prev != null)
                <a href="{{route('show.article',[$prev])}}">Previous</a>
            @endif
        </div>

        <div class="col-sm-6" style="text-align: right">
            @if($next!= null)
                <a href="{{route('show.article',[$next])}}">Next</a>
            @endif
        </div>
    </div>
@endsection