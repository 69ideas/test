@extends('frontend.layout')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="/">Vault-X.</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            Congratulations on creating your new VaultXIT Event.
            An email has been sent to you containing an invitation that you can forward to all of your participants. <br><br>
            <div align="center">
            The Event Number: <h2> {{$event->event_number}} </h2> <br>
            The Event Access Code:<h2> {{$event->event_code}} </h2> <br>
            </div>
            Your participants can access the event using the link on the email or through the “Find Event” button.
            You can also print out the invitation and hand it out to participants if that is easier.  Thanks for using VaultXIT.
            <div class="row">
                &nbsp;
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <a class="btn btn-primary btn-block btn-flat" href="{{route('event.show',$event)}}" style="background: #49658A;">Go to the Event</a>
                </div>
            </div>
        </div>
        <!-- /.login-box-body -->
    </div>

<div class="row">
    &nbsp;
</div>
<div class="row">
    &nbsp;
</div>
<div class="row">
    &nbsp;
</div>
<div class="row">
    &nbsp;
</div>
@endsection
