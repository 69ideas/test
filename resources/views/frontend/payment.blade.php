{!! Form::open(['route'=>['post.payment', $event]]) !!}
<div class="form-group">
    <label>Name 1
        <small
                data-toggle="tooltip"
                data-placement="top"
                title="Name"
        >
            <i class="fa fa-info-circle"></i>
        </small>
    </label>
    @if (\Auth::user())
        {!! Form::text('part['.$id.'][name]', \Auth::user()->full_name, ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
    @else
        {!! Form::text('part['.$id.'][name]', null, ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
    @endif
</div>
<div class="form-group">
    <label>E-mail 1
        <small
                data-toggle="tooltip"
                data-placement="top"
                title="Enter E-mail"
        >
            <i class="fa fa-info-circle"></i>
        </small>
    </label>
    @if (\Auth::user())
        {!! Form::text('part['.$id.'][email]', \Auth::user()->email, ['class'=>'form-control', 'placeholder'=>'Enter e-mail']) !!}
    @else
        {!! Form::text('part['.$id.'][email]', null, ['class'=>'form-control', 'placeholder'=>'Enter e-mail']) !!}
    @endif
</div>
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
    @if (\Auth::user())
        {!! Form::text('part['.$id.'][email_confirmation]', \Auth::user()->email, ['class'=>'form-control', 'placeholder'=>'Repeat e-mail']) !!}
    @else
        {!! Form::text('part['.$id.'][email_confirmation]', null, ['class'=>'form-control', 'placeholder'=>'Repeat e-mail']) !!}
    @endif
</div>
<div class="form-group">
    <label>Amount 1
        <small
                data-toggle="tooltip"
                data-placement="top"
                title="Enter Amount"
        >
            <i class="fa fa-info-circle"></i>
        </small>
    </label>
    @if($event->needable_sum>0)
        {!! Form::text('part['.$id.'][amount]', number_format($event->needable_sum,2), ['class'=>'form-control related-payment', 'placeholder'=>'Enter Amount','readonly'=>'readonly','id'=>'amount','data-event'=>$event->id]) !!}
    @else
        {!! Form::text('part['.$id.'][amount]',  null, ['class'=>'form-control related-payment', 'placeholder'=>'Enter Amount','id'=>'amount','data-event'=>$event->id]) !!}

    @endif
</div>
<div id="another_entry">

</div>

@if ($event->allow_anonymous)
    <div class="form-group">
        {!!  Form::checkbox('anonymous',1,null) !!} Anonymous
    </div>
@endif
<div class="form-group">
    <label>What are you using to make this payment? </label>
    {!!  Form::radio('type','paypal', true,['id'=>'type','class'=>'type']) !!} PayPal
    {!!  Form::radio('type','credit card',false,['class'=>'type']) !!} Credit Card
</div>

<div id="total_payment">

</div>
{{Form::hidden('event',$event)}}
<div class="row">

    <div class="col-md-2">{!! Form::submit('Pay',['class'=>'btn btn-primary']) !!} </div>
    <div class="col-md-6">
        <small>Pressing Pay will bring you to PayPal to make your payment. You do not need to have a PayPal account to
            make a credit card payment
        </small>
    </div>
    <div class="col-md-4">

        <button type="button" class='btn btn-primary another_entry' data-event="{{$event->id}}" id="another"
                data-id="{{$id}}">Add another Entry?
        </button>
    </div>

</div>

{!!  Form::close()!!}

