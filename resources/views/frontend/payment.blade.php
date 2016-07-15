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
        {!! Form::text('name', \Auth::user()->full_name, ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
    @else
        {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
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
        {!! Form::text('email', \Auth::user()->email, ['class'=>'form-control', 'placeholder'=>'Enter e-mail']) !!}
    @else
        {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Enter e-mail']) !!}
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
        {!! Form::text('email_confirmation', \Auth::user()->email, ['class'=>'form-control', 'placeholder'=>'Repeat e-mail']) !!}
    @else
        {!! Form::text('email_confirmation', null, ['class'=>'form-control', 'placeholder'=>'Repeat e-mail']) !!}
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
{{Form::hidden('event',$event)}}
<div class="form-group">
    {!! Form::submit('Pay',['class'=>'btn btn-primary']) !!}
</div>

{!!  Form::close()!!}

