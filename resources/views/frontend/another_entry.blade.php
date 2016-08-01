<div id="another_{{$id}}">
    <hr>
    <div class="box-body">
        <div class="form-group">
            <h4 class="participant_number">Participant</h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Name"
                        >
                            <i class="fa fa-info-circle">&nbsp&nbsp&nbsp</i>
                        </small>
                    </label>
                    @if ($event->allow_anonymous)
                        <label>{!!  Form::checkbox('part['.$id.'][anonymous]',1,null,['class'=>'anon']) !!}
                            Anonymous
                            <small
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Your name will appear as Anonymous to all but the coordinator"
                            >
                                <i class="fa fa-info-circle"></i>
                            </small>
                        </label>
                    @endif
                    {!! Form::text('part['.$id.'][name]', null, ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>E-mail
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="You will receive emails when changes are made to the event"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </label>
                    {!! Form::text('part['.$id.'][email]', null, ['class'=>'form-control', 'placeholder'=>'Enter e-mail']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Amount</label>
                    @if($event->needable_sum>0)
                        {!! Form::text('part['.$id.'][amount]', number_format($event->needable_sum,2), ['class'=>'form-control related-payment', 'id'=>'amount_2', 'placeholder'=>'Enter Amount','readonly'=>'readonly']) !!}
                    @else
                        {!! Form::text('part['.$id.'][amount]', null, ['class'=>'form-control related-payment', 'id'=>'amount_2', 'placeholder'=>'Enter Amount']) !!}
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Re-enter email address
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Re-enter email address"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </label>
                    {!! Form::text('part['.$id.'][email_confirmation]', null, ['class'=>'form-control', 'placeholder'=>'Repeat e-mail']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class='btn btn-primary btn-sm delete_another_entry pull-right'
                            data-event="{{$event->id}}"
                            id="delete_another"
                            data-id="{{$id}}">Delete additional Entry
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>