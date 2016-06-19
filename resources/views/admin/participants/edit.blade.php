<div>
    {!! Form::model($participant, ['route'=>['admin.participant.update', $participant],'class'=> \Request::ajax() ? 'ajax-form' : '', 'method'=>'PATCH']) !!}
    @include('admin.participants._manage')
    {!! Form::close() !!}
</div>


