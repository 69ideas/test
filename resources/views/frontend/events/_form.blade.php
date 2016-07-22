<div class="row">
    <div class="row">

        @if (!isset($event->closed_date))
            <div class="col-sm-4 col-sm-offset-8">
                {{ link_to_route('frontend.event.close', 'Close event', [$event], ['class'=>'btn btn-block btn-primary pull-right']) }}
            </div>
        @else
            <div class="col-sm-10">
                <h1><span class="label label-danger">CLOSED</span></h1>
            </div>
            <div class="col-sm-4 col-sm-offset-8">
                {{ link_to_route('frontend.event.open', 'Open event', [$event], ['class'=>'btn btn-block btn-primary pull-right']) }}
            </div>
        @endif
    </div>
    <div class="col-sm-12">
        <h1>Event # {{$event->id}}</h1>
        <h3 style="text-align: right">Coordinator: {{\Auth::user()->full_name}} </h3>
        <h4 style="text-align: right">Coordinar's Email: {{\Auth::user()->email}}</h4>
        <div class="box">
            <div class="box-header with-border">
                <div class="col-md-6"><h3 class="box-title">Event Data</h3></div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Date
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Date your event will be started."
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                @if (isset($event->start_date))
                                    <input type="text" class="form-control pull-right datepicker" name="start_date"
                                           value="{{old('start_date')?old('start_date'):$event->start_date->format('m/d/Y')}}">
                                @else
                                    <input type="text" class="form-control pull-right datepicker"
                                           value="{{old('start_date')}}" name="start_date">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deadline
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="This is a suggested date.  The Event will not automatically close after the date, nor will it keep a participant from being able to make a payment"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                @if (isset($event->deadline))
                                    <input type="text" class="form-control pull-right datepicker" name="deadline"
                                           value="{{old('deadline')?old('deadline'):$event->deadline->format('m/d/Y')}}">
                                @else
                                    <input type="text" class="form-control pull-right datepicker"
                                           value="{{old('deadline')}}" name="deadline">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Enter Number of Participants
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter the fixed number of participants for your event.  Enter “0” if you don’t want to set a limit"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::text('number_participants', 0, ['class'=>'form-control', 'placeholder'=>'Enter Number of Participants']) !!}
                        </div>

                        <div class="form-group">
                            @if (isset($event->needable_sum))
                                <label>Enter Amount per Participant</label>
                                <p class="form-control-static">{{$event->needable_sum}}</p>
                            @else
                                <label>Enter Amount per Participant
                                    <small
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Enter the fixed dollar amount each participants is to pay.  Enter “0” if you don’t want to set a limit "
                                    >
                                        <i class="fa fa-info-circle"></i>
                                    </small>
                                </label>
                                <div class="input-group">
                                     <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary" style="background: #49658A">
                                        &nbsp;<i class="fa fa-dollar"></i>&nbsp;</button>


                                 </span>
                                    {!! Form::text('needable_sum', null, ['placeholder'=>'No set amount','class'=>'form-control']) !!}

                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>PayPal Email
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter your PayPal account's email"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            @if (isset($event->paypal_email))
                                <br><p class="form-control-static">{{$event->paypal_email}}</p>
                            @else
                                {!! Form::email('paypal_email', null, ['class'=>'form-control', 'placeholder'=>'Enter your PayPal account\'s email']) !!}
                            @endif
                        </div>
                        <div class="form-group">
                            @if (isset($event->deadline))
                                Allow Anonymous? @if( $event->allow_anonymous)   <label> Yes </label>@else <label>
                                    No </label> @endif
                            @else
                                Allow Anonymous?
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="If you check this box, each participant will have the option to list themselves on the event page."
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                                <br>
                                {!!  Form::radio('allow_anonymous',true) !!} Yes
                                {!!  Form::radio('allow_anonymous',false,true) !!} No
                            @endif
                        </div>
                        <div class="form-group">
                            @if (isset($event->deadline))
                                Fee taken out of Total? @if( $event->vxp_fees)   <label> Yes </label>@else <label>
                                    No </label> @endif
                            @else
                                Event Fee taken out of Total?
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="An Option that the Event Fee will be taken out to the total collected.  Otherwise the Coordinator will have to pay it."
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                                <br>
                                {!!  Form::radio('vxp_fees',true,true) !!} Yes
                                {!!  Form::radio('vxp_fees',false) !!} No
                            @endif
                        </div>
                        <div class="form-group">
                            @if (isset($event->deadline))
                                Credit Card Fees taken out of Total? @if( $event->cc_fees)    <label> Yes </label>@else
                                    <label> No </label> @endif
                            @else
                                Credit Card Fees taken out of Total?
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="An Option that the CC Fees will be taken out to the total collected.  Otherwise the participants will have it added when they make their payment"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                                <br>
                                {!!  Form::radio('cc_fees',true) !!} Yes
                                {!!  Form::radio('cc_fees',false,true) !!} No
                            @endif
                        </div>


                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Short Description
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="In this area you enter up to 25 characters that explains to your participants the purpose of the event."
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::text('short_description', null, ['class'=>'form-control', 'placeholder'=>'Short Description','maxlength'=>'25']) !!}
                        </div>
                        <div class="form-group">
                            <label>Description
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Fully describe your Event"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </label>
                            {!! Form::textarea('description', null, ['class'=>'wysiwyg form-control', 'placeholder'=>'Enter Description']) !!}
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            {!! Form::file('image') !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {!! Form::submit($submit_text, ['class'=>'btn btn-primary','style'=>"background: #49658A;"]) !!}
        <a href="{{ route('event.show',$event) }}" class="btn btn-primary" style="background: #49658A;"><i
                    class="fa fa-angle-double-left"></i>
            Back
        </a>
    </div>
</div>