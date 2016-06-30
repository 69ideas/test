<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="col-md-6"><h3 class="box-title">Event Data</h3></div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!!  Form::label('start_date','Start Date:') !!}
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
                            {!!  Form::label('deadline','Deadline:') !!}
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
                            <label>Enter Amount per Participant</label>
                            {!! Form::text('needable_sum', null, ['class'=>'form-control', 'placeholder'=>'Enter Required amount']) !!}
                        </div>
                        <div class="form-group">
                            <label>Enter Number of Participants</label>
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
                                        title="In this area you enter up to x characters that explains to your participants the purpose of the event."
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
                            {!!  Form::checkbox('vxp_fees') !!} Event Fee taken out of Total?
                        </div>
                        <div class="form-group">
                            {!!  Form::checkbox('cc_fees') !!} Credit Card Fees taken out of Total?
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