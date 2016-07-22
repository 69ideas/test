<div>
    @foreach($response as $item)
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Amount
                    <small
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Amount"
                    >
                        <i class="fa fa-info-circle"></i>
                    </small>
                </label>

                {!! Form::text('', '$'.number_format($item['donation'],2), ['class'=>'form-control', 'disabled'=>'disabled']) !!}
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
                @if($item['cc']!=0)
                    {!! Form::text('', '$'.number_format($item['cc'],2), ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                @else
                    {!! Form::text('', 'Not Applicable', ['class'=>'form-control', 'disabled'=>'disabled']) !!}
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

                @if($item['vxp']!=0)
                    {!! Form::text('', '$'.number_format($item['vxp'],2), ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                @else
                    {!! Form::text('', 'Not Applicable', ['class'=>'form-control', 'disabled'=>'disabled']) !!}
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

                {!! Form::text('', '$'.number_format($item['total'],2), ['class'=>'form-control', 'disabled'=>'disabled']) !!}
            </div>
        </div>
    </div>
    @endforeach

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

            {!! Form::text('total', '$'.number_format(collect($response)->sum('total'),2), ['class'=>'form-control', 'disabled'=>'disabled']) !!}
        </div>
</div>