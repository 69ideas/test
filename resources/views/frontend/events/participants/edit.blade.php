<div>
    {!! Form::model($participant, ['route'=>['admin.participant.update', $participant],'class'=> \Request::ajax() ? 'ajax-form' : '', 'method'=>'PATCH']) !!}
    @include('frontend.events.participants._manage')
    {!! Form::close() !!}
</div>


