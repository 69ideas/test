<div>
    <div class="form-group">
        <label>Name 2
            <small
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Name"
            >
                <i class="fa fa-info-circle"></i>
            </small></label>
        {!! Form::text('name_2', null, ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
    </div>
    <div class="form-group">
        <label>E-mail 2
            <small
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Enter E-mail"
            >
                <i class="fa fa-info-circle"></i>
            </small></label>
        {!! Form::text('email_2', null, ['class'=>'form-control', 'placeholder'=>'Enter e-mail']) !!}
    </div>
    <div class="form-group">
        <label>Amount 2
            <small
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Enter Amount"
            >
                <i class="fa fa-info-circle"></i>
            </small></label>
        {!! Form::text('amount_2', null, ['class'=>'form-control related-payment', 'id'=>'amount_2', 'placeholder'=>'Enter Amount']) !!}
    </div>
</div>