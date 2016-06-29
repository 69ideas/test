@extends('frontend.layout')
@section('content')
    {!! Form::open(['style'=>'display:inline-block', 'method'=>'get'])!!}
    <div class="input-group">
        <input type="text" class="form-control pull-right" name="q" value="{{ $q }}">
        <span class="input-group-btn">
            <button class="btn btn-primary" type="submit" style="background: #49658A">
                &nbsp;<i class="fa fa-search"></i>&nbsp;
            </button>
        </span>
    </div>
    {{Form::close()}}
    <div class="row">
        &nbsp;
    </div>
    @foreach($events->chunk(4) as $chunk)
        <div class="row">

            @foreach($chunk as $event)
                <div class="col-md-3">
                    <h3><a href="{{route('show.event',[$event])}}">{{$event->title}}</a></h3>
                    <hr>
                    @if (($event->image)=='')
                        <a href="{{route('show.event',[$event])}}"><img src="{{$event->image}}" style="width: 100%"></a>
                    @endif
                    <div class="row">
                        &nbsp;
                    </div>
                    {{$event->short_description}}
                </div>
            @endforeach
        </div>

    @endforeach
@endsection