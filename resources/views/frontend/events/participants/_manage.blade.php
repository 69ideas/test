<div class="box-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Participant:
                    <small
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Set '--Not set--' if user has not got account on Vault-x"
                    >
                        <i class="fa fa-info-circle"></i>
                    </small>
                </label>
                {!!  Form::select('user_id', $users, null,['class'=>"form-control select2 related-name"]) !!}
            </div>
            <div id="data_holder">

            </div>
            <div class="form-group">
                {!!  Form::label('amount_deposited','Amount Deposit:') !!}
                <div class="input-group">
                <span class="input-group-btn">
                                    <button class="btn btn-primary" style="background: #49658A">
                                        &nbsp;<i class="fa fa-dollar"></i>&nbsp;</button>

                                 </span>
                    {!!  Form::text('amount_deposited',null,['class'=>"form-control"]) !!}
                </div>
            </div>
        <!--<div class="form-group">
                {!!  Form::label('deposit_type','Deposit Type:') !!}

        {!!  Form::text('deposit_type',null,['class'=>"form-control"]) !!}

                </div>-->
            <div class="form-group">
                {!!  Form::label('deposit_date','Deposit Date:') !!}
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    @if (isset($participant->deposit_date))
                        <input type="text" class="form-control pull-right datepicker" name="deposit_date"
                               value="{{$participant->deposit_date->format('m/d/Y')}}">
                    @else
                        <input type="text" class="form-control pull-right datepicker" name="deposit_date">
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('type', \Request::get('type')) !!}
    {!! Form::hidden('id', \Request::get('id')) !!}
    <div class="form-group">
        {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}
    </div>
</div>
