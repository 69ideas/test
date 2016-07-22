{!! Form::open(['route'=>['post.send.email', $event]]) !!}
<div class="form-group">
    <label>E-mail
        <small
                data-toggle="tooltip"
                data-placement="top"
                title="Enter E-mail"
        >
            <i class="fa fa-info-circle"></i>
        </small></label>
    {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Enter e-mail']) !!}
    {{Form::hidden('id',$event->id)}}
</div>
<div class="form-group">
        {!! Form::submit('Send',['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}


