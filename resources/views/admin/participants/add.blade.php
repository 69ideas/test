<div>
    @include('admin.validation.all')
    {!! Form::open(['route'=>'admin.participant.store', 'class'=> \Request::ajax() ? 'ajax-form' : '','files'=>true]) !!}
    @include('admin.participants._manage')
    {{Form::close()}}
</div>
