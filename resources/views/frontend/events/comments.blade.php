<div>
    <div align="center">
        <h2>Event Message Board</h2>
    </div>
    @if (count($event->comments()->get()) > 0)
        <hr>
        @foreach($event->comments()->get() as $comment)
            <label>{{$comment->created_at->format('m/d/y')}}, {{$comment->user->full_name}}
                :</label>  {{$comment->comment}}
            <br>
        @endforeach
    @endif

    {!! Form::open(['route'=>['comment']]) !!}
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Add your comment:
                </label>
                {!!  Form::textarea('comment', null,['class'=>"form-control"]) !!}
            </div>
            {{Form::hidden('event',$event->id)}}
            {{Form::submit('Add Comment',['class'=>"btn btn-primary btn-block"])}}

        </div>
    </div>
    {!! Form::close() !!}
    <br>
</div>