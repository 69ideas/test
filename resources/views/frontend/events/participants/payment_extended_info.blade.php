<div>
    <div class="form-group">
        <div>
            {!!  Form::label('name','Name:') !!}
            {!!  Form::text('name',null,['class'=>"form-control", 'placeholder'=>'Enter Name']) !!}
        </div>
    </div>
    <div class="form-group">
        <div>
            {!!  Form::label('email','Email:') !!}
            {!!  Form::email('email',null,['class'=>"form-control", 'placeholder'=>'Enter e-mail']) !!}
        </div>
    </div>
</div>