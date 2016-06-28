@extends('frontend.layout')

@section('content')
    <div class="row">
        @if (!$event->is_close)
            <div class="col-sm-4 col-sm-offset-8">
                {{ link_to_route('admin.event.close', 'Close event', [$event], ['class'=>'btn btn-block btn-primary pull-right']) }}
            </div>
        @else
            <div class="col-sm-12">
                <h1><span class="label label-danger">CLOSED</span></h1>
            </div>
        @endif
    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <div class="col-sm-12">
            @include('admin.validation.all')
        </div>
    </div>

    <div class="row">
        &nbsp;
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="col-md-6"><h3 class="box-title">Event Data</h3></div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Date</label>
                                <p class="form-control-static">@if (isset($event->start_date)){{$event->start_date->format('m/d/Y')}}@endif</p>
                            </div>
                            <div class="form-group">
                                <label>Closed Date</label>
                                <p class="form-control-static">@if (isset($event->closed_date)){{$event->closed_date->format('m/d/Y')}}@endif</p>
                            </div>
                            <div class="form-group">
                                <label>Deadline</label>
                                <p class="form-control-static">@if (isset($event->deadline)){{$event->deadline->format('m/d/Y')}}@endif</p>
                            </div>
                            <div class="form-group">
                                Allow Anonymous? @if( $event->allow_anonymous)  <i
                                        class="fa fa-check"></i> @else <i class="fa fa-close"></i>@endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Short Description</label>
                                <p class="form-control-static">{{$event->shor_decription}}</p>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <p class="form-control-static">{{$event->decription}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Image Title</label>
                                <p class="form-control-static">{{$event->title}}</p>
                            </div>
                            <div class="form-group">
                                @if(isset($event->image))
                                    <img src="/{{$event->image}}" style="width: 100%"/>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            @include('frontend.events._tabs')
            <a href="{{ route('event.edit',$event) }}" class="btn btn-primary" style="background: #49658A;"><i
                        class="fa fa-pencil"></i>
                Edit
            </a>
            <a href="{{ route('event.index') }}" class="btn btn-primary" style="background: #49658A;"><i
                        class="fa fa-angle-double-left"></i>
                Back
            </a>
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>


@endsection