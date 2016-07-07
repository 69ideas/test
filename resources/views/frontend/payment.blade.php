{!! Form::open(['route'=>['post.payment', $event]]) !!}
<div class="form-group">
    <label>Name
        <small
                data-toggle="tooltip"
                data-placement="top"
                title="Name"
        >
            <i class="fa fa-info-circle"></i>
        </small></label>
    {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
</div>
<div class="form-group">
    <label>E-mail
        <small
                data-toggle="tooltip"
                data-placement="top"
                title="Enter Paypal E-mail"
        >
            <i class="fa fa-info-circle"></i>
        </small></label>
    {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Enter Paypal e-mail']) !!}
</div>
<div class="form-group">
    <label>Amount
        <small
                data-toggle="tooltip"
                data-placement="top"
                title="Enter Amount"
        >
            <i class="fa fa-info-circle"></i>
        </small></label>
    {!! Form::text('amount', null, ['class'=>'form-control related-payment', 'placeholder'=>'Enter Amount','data-event'=>$event->id]) !!}
</div>
<div id="total_payment">

</div>
<div class="form-group">
    {!! Form::submit('Pay',['class'=>'btn btn-primary']) !!}
</div>
{{Form::hidden('event',$event)}}
{!!  Form::close()!!}

