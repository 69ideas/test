@extends('frontend.layout')

@section('content')

    @if($event->isCoordinator(\Auth::user()) && $event->CountFees()>0)
                <div class="alert alert-danger">
                    Your outstanding balance is ${{$event->CountFees()}}. <a href="{{route('pay_fee', $event)}}">Pay
                        now.</a>
                </div>
    @else
        <div class="alert alert-success">
            Your outstanding balance is clear.</a>
        </div>

    @endif
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
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="form-group">{{$event->short_description}}</h1>
                    <h4 class="form-group">Event # {{$event->event_number}}</h4>
                </div>
                <div class="col-sm-6">
                    <h1 class="form-group" style="text-align: right">Coordinator: {{$event->user->full_name}} </h1>
                    <h4 class="form-group" style="text-align: right">Coordinator's Email: {{$event->user->email}}</h4>
                </div>
            </div>
            <div class="box">
                <div class="box-header with-border">
                    <div class="col-md-6"><h3 class="box-title">{!!  $event->description !!}</h3></div>
                </div>
                <div class="box-body">
                    <div class="row form-group">
                        <div class="col-md-3">
                            <div class="form-group">
                                <p class="form-control-static">@if (isset($event->start_date)) <strong> You can begin
                                        participating as of:</strong> {{$event->start_date->format('m/d/Y')}}@endif</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <p class="form-control-static">@if (isset($event->deadline))<strong> Submit
                                        by </strong>{{$event->deadline->format('m/d/Y')}}@endif</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <p class="form-control-static"><strong> Maximum number of
                                        participants
                                        is </strong>@if($event->number_participants!=0) {{$event->number_participants}} @else
                                        "Unlimited" @endif</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <p class="form-control-static"><strong> Amount per Participant is </strong>
                                    @if($event->needable_sum>0)${{$event->needable_sum}} @else "No Set Amount" @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                @if( $event->cc_fees)Credit Card Fees will be taken out of your amount
                                @else Credit Card Fee will be added to your amount @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @if( $event->allow_anonymous)You will have the option to appear as anonymous on the form
                                below @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <strong>Paypal Email</strong><br>{{$event->paypal_email}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(!$event->is_close)
                    @if($is_guest)
                        @if(((count($event->payed_participants) < $event->number_participants || $event->number_participants==0)&& is_null($event->closed_date))&&$event->allow_anonymous)
                            <div class="form-group">
                                <a href="{{route('payment',[$event])}}"
                                   class="btn btn-primary make-payment alignright"><i class="fa fa-paypal"></i> Make a
                                    Payment</a>
                            </div>
                        @endif
                    @else
                        @if(((count($event->payed_participants) < $event->number_participants || $event->number_participants==0)&& is_null($event->closed_date)))
                            <div class="form-group">
                                <a href="{{route('payment',[$event])}}"
                                   class="btn btn-primary make-payment alignright"><i class="fa fa-paypal"></i> Make a
                                    Payment</a>
                            </div>
                        @endif

                    @endif
                </div>
            @endif

            @include('frontend.events._tabs')
            @if(\Auth::user()!=null)
                @if(\Auth::user()->id==$event->user_id)
                    <a href="{{ route('event.edit',$event) }}" class="btn btn-primary" style="background: #49658A;"><i
                                class="fa fa-pencil"></i>
                        Edit
                    </a>
                    <a href="/event/send?id={{$event->id}}"
                       class="btn btn-primary send-event" style="background: #49658A;"><i class="fa fa-envelope-o"></i>
                        Email Invite
                    </a>

                    <a href="{{ route('event.index') }}" class="btn btn-primary" style="background: #49658A;"><i
                                class="fa fa-angle-double-left"></i>
                        Back
                    </a>
                @endif
            @endif
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>


@endsection
@if($is_guest)
    <script>
        function close_modal_div() {
            $('#modal_div').hide()
        }
    </script>
    <div id="modal_div" class="modal" role="dialog" style="display: block; z-index:100500">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="close_modal_div()">&times;</button>
                    <h4 class="modal-title">Please login</h4>
                </div>
                <div class="modal-body">
                    <p>You are logged in as a GUEST. Would you like create/login to your account?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{route('login')}}" type="button" class="btn btn-default">Yes</a>
                    <button type="button" class="btn btn-default" onclick="close_modal_div()">No</button>
                </div>
            </div>

        </div>
    </div>
@endif