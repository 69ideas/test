@if(Session::has('error_message'))
    <div class="alert alert-danger">
        {!! Session::get('error_message') !!}
    </div>
@endif