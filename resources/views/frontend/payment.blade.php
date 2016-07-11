{!! Form::open(['route'=>['post.payment', $event]]) !!}
<div class="form-group">
    <label>Name 1
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
    <label>E-mail 1
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
    <label>Re-enter email address
        <small
                data-toggle="tooltip"
                data-placement="top"
                title="Re-enter email address"
        >
            <i class="fa fa-info-circle"></i>
        </small></label>
    {!! Form::text('email_confirmation', null, ['class'=>'form-control', 'placeholder'=>'Repeat Paypal e-mail']) !!}
</div>
<div class="form-group">
    <label>Amount 1
        <small
                data-toggle="tooltip"
                data-placement="top"
                title="Enter Amount"
        >
            <i class="fa fa-info-circle"></i>
        </small></label>
    {!! Form::text('amount', null, ['class'=>'form-control related-payment', 'placeholder'=>'Enter Amount','id'=>'amount','data-event'=>$event->id]) !!}
</div>
<div class="form-group">
    {!!  Form::checkbox('another_entry',1,null,['class'=>'another_entry']) !!} Add another Entry?
</div>
@if ($event->allow_anonymous)
    <div class="form-group">
        {!!  Form::checkbox('anonymous',1,null) !!} Anonymous
    </div>
    @endif
<div id="another_entry">

</div>
<div id="total_payment">

</div>
<div class="form-group">
    {!! Form::submit('Pay',['class'=>'btn btn-primary']) !!}
</div>
{{Form::hidden('event',$event)}}
{!!  Form::close()!!}

