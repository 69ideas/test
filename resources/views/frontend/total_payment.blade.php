<div>
    @foreach($response as $item)
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Amount {{$item['mid']}}</label>
                    {!! Form::text('', '$'.number_format($item['donation'],2), ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                </div>
                <div class="form-group">
                    <label>CC Fees {{$item['mid']}}
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="PayPal Credit Card Fee of 2.9% + 30 cents"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </label>
                    @if($item['cc']!=0)
                        {!! Form::text('', '$'.number_format($item['cc'],2), ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                    @else
                        {!! Form::text('', '$0.00', ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>VXP Fees {{$item['mid']}}
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="VaultX fee of .5% no less than 20 cents"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </label>

                    @if($item['vxp']!=0)
                        {!! Form::text('', '$'.number_format($item['vxp'],2), ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                    @else
                        {!! Form::text('', '$0.00', ['class'=>'form-control', 'disabled'=>'disabled']) !!}
                    @endif
                </div>
                <div class="form-group">
                    <label>Total {{$item['mid']}}
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Exactly what is charged for this entry"
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
    @if(collect($response)->sum('total')>0)
        <div class="form-group">
            <label>Total Payment
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Exactly what is charged for all entries"
                >
                    <i class="fa fa-info-circle"></i>
                </small>
            </label>

            {!! Form::text('total', '$'.number_format(collect($response)->sum('total'),2), ['class'=>'form-control', 'disabled'=>'disabled']) !!}
        </div>
    @endif
</div>