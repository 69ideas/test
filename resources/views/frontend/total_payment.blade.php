<div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Donation
                    <small
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Donation"
                    >
                        <i class="fa fa-info-circle"></i>
                    </small>
                </label>

                {!! Form::text('total', '$'.($total_1-$cc_fees_1-$vxp_fees_1), ['class'=>'form-control', 'disabled'=>'disabled']) !!}
            </div>
            <div class="form-group">
                <label>CC Fees
                    <small
                            data-toggle="tooltip"
                            data-placement="top"
                            title="CC Fees"
                    >
                        <i class="fa fa-info-circle"></i>
                    </small>
                </label>
                @if($cc_fees_1!=0)
                    {!! Form::text('total', '$'.$cc_fees_1, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                @else
                    {!! Form::text('total', 'Not Applicable', ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>VXP Fees
                    <small
                            data-toggle="tooltip"
                            data-placement="top"
                            title="VXP Fees"
                    >
                        <i class="fa fa-info-circle"></i>
                    </small>
                </label>

                @if($vxp_fees_1!=0)
                    {!! Form::text('total', '$'.$vxp_fees_1, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                @else
                    {!! Form::text('total', 'Not Applicable', ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                @endif
            </div>
            <div class="form-group">
                <label>Total
                    <small
                            data-toggle="tooltip"
                            data-placement="top"
                            title="This is the sum which You should pay on Paypal with commissions"
                    >
                        <i class="fa fa-info-circle"></i>
                    </small>
                </label>

                {!! Form::text('total', '$'.$total_1, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
            </div>
        </div>
    </div>
    @if ($other==1)
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Donation 2
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Donation"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </label>

                    {!! Form::text('total', '$'.($total_2-$cc_fees_2-$vxp_fees_2), ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                </div>
                <div class="form-group">
                    <label>CC Fees 2
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="CC Fees"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </label>
                    @if($cc_fees_2!=0)
                        {!! Form::text('total', '$'.$cc_fees_2, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                    @else
                        {!! Form::text('total', 'Not Applicable', ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>VXP Fees 2
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="VXP Fees"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </label>
                    @if($vxp_fees_2!=0)
                        {!! Form::text('total', '$'.$vxp_fees_2, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                    @else
                        {!! Form::text('total', 'Not Applicable', ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                    @endif
                </div>
                <div class="form-group">
                    <label>Total 2
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="This is the sum which You should pay on Paypal with commissions"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </label>

                    {!! Form::text('total', '$'.$total_2, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                </div>
            </div>
        </div>
    <hr>
        <div class="form-group">
            <label>Summary
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Summary"
                >
                    <i class="fa fa-info-circle"></i>
                </small>
            </label>

            {!! Form::text('total', '$'.$total, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
        </div>
    @endif
</div>