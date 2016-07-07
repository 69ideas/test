<div>
    @include('admin.validation.all')
    {!! Form::open(['route'=>'participant.store', 'class'=> \Request::ajax() ? 'ajax-form' : '','files'=>true]) !!}
    @include('frontend.events.participants._manage')
    {{Form::close()}}
</div>
