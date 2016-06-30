<div class="row">
    <div class="col-sm-12">
        <h1>Event # {{$event->id}}</h1>
        <h3>Coordinator: {{\Auth::user()->full_name}} {{\Auth::user()->email}}</h3>
        <div class="box">
            <div class="box-header with-border">
                <div class="col-md-6"><h3 class="box-title">Event Data</h3></div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Date <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Date when your Event will started"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small></label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                @if (isset($event->start_date))
                                    <input type="text" class="form-control pull-right datepicker" name="start_date"
                                           value="{{$event->start_date->format('m/d/Y')}}">
                                @else
                                    <input type="text" class="form-control pull-right datepicker" name="start_date">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deadline <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="This is a suggested date.  The Event will not automatically close after the date, nor will it keep a participant from being able to make a payment"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small></label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                @if (isset($event->deadline))
                                    <input type="text" class="form-control pull-right datepicker" name="deadline"
                                           value="{{$event->deadline->format('m/d/Y')}}">
                                @else
                                    <input type="text" class="form-control pull-right datepicker" name="deadline">
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Enter Amount per Participant <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter the fixed dollar amount each participants is to pay.  Enter “0” if you don’t want to set a limit "
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small></label>
                            {!! Form::text('needable_sum', null, ['class'=>'form-control', 'placeholder'=>'Enter Required amount']) !!}
                        </div>
                        <div class="form-group">
                            <label>Enter Number of Participants <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Enter the fixed number of participants for your event.  Enter “0” if you don’t want to set a limit"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small></label>
                            {!! Form::text('number_participants', null, ['class'=>'form-control', 'placeholder'=>'Enter Number of Participants']) !!}
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            {!! Form::file('image') !!}
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Short Description  <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="In this area you enter up to 255 characters that explains to your participants the purpose of the event."
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small></label>
                            {!! Form::text('short_description', null, ['class'=>'form-control', 'placeholder'=>'Short Description']) !!}
                        </div>
                        <div class="form-group">
                            <label>Description<small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="In this area you enter up to x characters that explains to your participants the purpose of the event."
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small></label>
                            {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>'Enter Description']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::checkbox('allow_anonymous') !!} Allow Anonymous? <small
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="If you type “check” each participant will be able to list themselves as anonymous on the Event ."
                            >
                                <i class="fa fa-info-circle"></i>
                            </small>
                        </div>
                        <div class="form-group">
                            {!!  Form::checkbox('vxp_fees') !!} Event Fee taken out of Total?<small
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="An Option that the Event Fee will be taken out to the total collected.  Otherwise the Coordinator will have to pay it."
                            >
                                <i class="fa fa-info-circle"></i>
                            </small>
                        </div>
                        <div class="form-group">
                            {!!  Form::checkbox('cc_fees') !!} Credit Card Fees taken out of Total?<small
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="An Option that the CC Fees will be taken out to the total collected.  Otherwise the participants will have it added when they make their payment"
                            >
                                <i class="fa fa-info-circle"></i>
                            </small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {!! Form::submit($submit_text, ['class'=>'btn btn-primary']) !!}
        <a href="{{ route('event.show',$event) }}" class="btn btn-primary"><i
                    class="fa fa-angle-double-left"></i>
            Back
        </a>
    </div>
</div>