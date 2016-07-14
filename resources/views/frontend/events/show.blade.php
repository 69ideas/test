@extends('frontend.layout')

@section('content')
    <div class="row">
        @if (!$event->is_close && $event->user_id=\Auth::user()->id)
            <div class="col-sm-4 col-sm-offset-8">
                {{ link_to_route('admin.event.close', 'Close event', [$event->id], ['class'=>'btn btn-block btn-primary pull-right']) }}
            </div>
        @elseif(!$event->is_close)
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
            <h1>Event # {{$event->id}}</h1>
            <h3 style="text-align: right">Coordinator: {{$event->user->full_name}} </h3>
            <h4 style="text-align: right">Coordinar's Email:   {{$event->user->email}}</h4>
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
                                <label>Deadline</label>
                                <p class="form-control-static">@if (isset($event->deadline)){{$event->deadline->format('m/d/Y')}}@endif</p>
                            </div>
                            <div class="form-group">
                                <label>Event Coordinator</label>
                                <p class="form-control-static">@if (isset($event->user_id)){{$event->user->full_name}}@else
                                        Not set @endif</p>
                                <p class="form-control-static">@if (isset($event->user_id)){{$event->user->email}}@else
                                        Not set @endif</p>
                            </div>
                            <div class="form-group">
                                Allow Anonymous? @if( $event->allow_anonymous)   <label> Yes </label>@else <label> No  </label> @endif
                            </div>
                            <div class="form-group">
                                Fee taken out of Total? @if( $event->vxp_fees)   <label> Yes </label>@else <label> No  </label> @endif
                            </div>
                            <div class="form-group">
                                Credit Card Fees taken out of Total? @if( $event->cc_fees)   <label> Yes </label>@else <label> No  </label> @endif
                            </div>
                            <div class="form-group">
                                <label>PayPal E-mail</label>
                                <p class="form-control-static">{{$event->paypal_email}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Short Description</label>
                                <p class="form-control-static">{{$event->short_description}}</p>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <p class="form-control-static">{!!  $event->description!!}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Number of Participants</label>
                                <p class="form-control-static">@if($event->number_participants!=0){{$event->number_participants}} @else no limit @endif</p>
                            </div>
                            <div class="form-group">
                                <label>Enter Amount per Participant</label>
                                <p class="form-control-static">@if(!$event->needable_sum || $event->needable_sum!=0)${{$event->needable_sum}} @else No limit @endif</p>
                            </div>
                            <div class="form-group">
                                @if($event->image!='')
                                    <img src="/{{$event->image}}" style="width: 100%"/>
                                @else
                                    <img src="/images/no-image.png" style="width: 100%"/>
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