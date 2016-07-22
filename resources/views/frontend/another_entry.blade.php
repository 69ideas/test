<div>
    <div class="form-group">
        <label>Name {{$id+1}}
            <small
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Name"
            >
                <i class="fa fa-info-circle"></i>
            </small></label>
        {!! Form::text('part['.$id.'][name]', null, ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
    </div>
    <div class="form-group">
        <label>E-mail {{$id+1}}
            <small
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Enter E-mail"
            >
                <i class="fa fa-info-circle"></i>
            </small></label>
        {!! Form::text('part['.$id.'][email]', null, ['class'=>'form-control', 'placeholder'=>'Enter e-mail']) !!}
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
            {!! Form::text('part['.$id.'][email_confirmation]', null, ['class'=>'form-control', 'placeholder'=>'Repeat e-mail']) !!}
    </div>
    <div class="form-group">
        <label>Amount {{$id+1}}
            <small
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Enter Amount"
            >
                <i class="fa fa-info-circle"></i>
            </small></label>
        @if($event->needable_sum>0)
        {!! Form::text('part['.$id.'][amount]', $event->needable_sum, ['class'=>'form-control related-payment', 'id'=>'amount_2', 'placeholder'=>'Enter Amount','readonly'=>'readonly']) !!}
        @else
            {!! Form::text('part['.$id.'][amount]', null, ['class'=>'form-control related-payment', 'id'=>'amount_2']) !!}
        @endif
    </div>
</div>