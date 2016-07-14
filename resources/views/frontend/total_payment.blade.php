<div>
<div class="form-group">
    <label>Total
        <small
                data-toggle="tooltip"
                data-placement="top"
                title="This is the sum which You should pay on Paypal with commissions"
        >
            <i class="fa fa-info-circle"></i>
        </small></label>

    {!! Form::text('total', '$'.$total, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
</div>
</div>