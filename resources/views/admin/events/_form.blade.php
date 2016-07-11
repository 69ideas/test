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
                            <label>Coordinator</label>
                            {!! Form::select('user_id', $coordinators,null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>SEO Title</label>
                            {!! Form::text('seo_title', null, ['class'=>'form-control', 'placeholder'=>'SEO Title']) !!}
                        </div>
                        <div class="form-group">
                            <label>SEO Description</label>
                            {!! Form::text('seo_description', null, ['class'=>'form-control', 'placeholder'=>'Enter SEO Description']) !!}
                        </div>
                        <div class="form-group">
                            <label>SEO Keywords</label>
                            {!! Form::text('seo_keywords', null, ['class'=>'form-control', 'placeholder'=>'Enter SEO Keywords']) !!}
                        </div>
                        <div class="form-group">
                            <label>Sort Order</label>
                            {!! Form::text('sort_order', null, ['class'=>'form-control', 'placeholder'=>'Enter Sort Order']) !!}
                        </div>
                        <div class="form-group">
                            <label>Enter Amount per Participant</label>
                            {!! Form::text('needable_sum', null, ['class'=>'form-control', 'placeholder'=>'Enter Required amount']) !!}
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Short Description</label>
                            {!! Form::text('short_description', null, ['class'=>'form-control', 'placeholder'=>'Short Description']) !!}
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            {!! Form::textarea('description', null, ['class'=>'wysiwyg form-control', 'placeholder'=>'Enter Description']) !!}
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            {!! Form::file('image') !!}
                        </div>
                        <div class="form-group">
                            <label>Enter Number of Participants</label>
                            {!! Form::text('number_participants', null, ['class'=>'form-control', 'placeholder'=>'Short Description']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::checkbox('allow_anonymous') !!} Allow Anonymous?
                        </div>
                        <div class="form-group">
                            {!!  Form::checkbox('vxp_fees') !!} Event Fee taken out of Total?
                        </div>
                        <div class="form-group">
                            {!!  Form::checkbox('cc_fees') !!} Credit Card Fees taken out of Total?
                        </div>
                        <div class="form-group">
                            <label>Enter PayPal account</label>
                        {!! Form::email('paypal_email', null, ['class'=>'form-control', 'placeholder'=>'Enter your PayPal account\'s email']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::submit($submit_text, ['class'=>'btn btn-primary']) !!}
        <a href="{{ route('admin.event.show',$event) }}" class="btn btn-primary"><i
                    class="fa fa-angle-double-left"></i>
            Back
        </a>
    </div>
</div>