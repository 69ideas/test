<div>
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

        {!! Form::text('total', '$'.$cc_fees_1, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
    </div>
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

        {!! Form::text('total', '$'.$vxp_fees_1, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
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
    @if ($other==1)
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

            {!! Form::text('total', '$'.$cc_fees_2, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
        </div>
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

            {!! Form::text('total', '$'.$vxp_fees_2, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
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