<div>
    <div class="form-group">
        {!!  Form::label('user_id','Name:') !!}
        {!!  Form::text('name',null,['class'=>"form-control", 'placeholder'=>'Enter Name']) !!}
    </div>
    <div class="form-group">
        {!!  Form::label('email','Email:') !!}
        {!!  Form::email('email',null,['class'=>"form-control", 'placeholder'=>'Enter e-mail']) !!}
    </div>
</div>