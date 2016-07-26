<div id="another_{{$id}}">
    <hr>
    <div class="box-body">
        <div class="form-group">
            <h4>Next participant</h4>
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
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </label>
                    {!! Form::text('part['.$id.'][name]', null, ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>E-mail
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Enter E-mail"
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
            <div class="col-md-6">
                <div class="form-group">
                    <label>Amount
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Enter Amount"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </label>
                    @if($event->needable_sum>0)
                        {!! Form::text('part['.$id.'][amount]', $event->needable_sum, ['class'=>'form-control related-payment', 'id'=>'amount_2', 'placeholder'=>'Enter Amount','readonly'=>'readonly']) !!}
                    @else
                        {!! Form::text('part['.$id.'][amount]', null, ['class'=>'form-control related-payment', 'id'=>'amount_2']) !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    @if ($event->allow_anonymous)
                        <div class="form-group">
                            {!!  Form::checkbox('anonymous',1,null) !!} Anonymous
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
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