@extends('frontend.emails.layout')
@section('content')
    <table bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="500" id="emailBody">
        <tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="color:#FFFFFF;"
                       bgcolor="#3498db">
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="500"
                                   class="flexibleContainer">
                                <tr>
                                    <td align="center" valign="top" width="500"
                                        class="flexibleContainerCell">
                                        <table border="0" cellpadding="30" cellspacing="0" width="100%">
                                            <tr>
                                                <td align="center" valign="top" class="textContent">
                                                    <h1 style="color:#FFFFFF;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px;text-align:center;">
                                                        Hello, All </h1>
                                                    <div style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:135%;">
                                                        My name
                                                        is @if(isset($user->full_name)){{$user->full_name}}@else{{$user->email}}@endif
                                                        . You are invited to participate in the event below I have
                                                        decided to use VaultXchange to help organize and collect for the
                                                        event. It is a powerful tool that will help give everybody
                                                        visibility to the event plus an easy way to make a deposit.
                                                        Please click on the link below to view the event.
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr mc:hideable>
            <td align="center" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="30" cellspacing="0" width="500"
                                   class="flexibleContainer">
                                <tr>
                                    <td align="center" valign="top">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                               bgcolor="#F8F8F8">
                                            <tr>
                                                <td align="center" valign="top">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                           width="500" class="flexibleContainer">
                                                        <tr>
                                                            <td align="center" valign="top" width="500"
                                                                class="flexibleContainerCell">
                                                                <table border="0" cellpadding="30"
                                                                       cellspacing="0" width="100%">
                                                                    <tr>
                                                                        <td align="center" valign="top">
                                                                            <table border="0"
                                                                                   cellpadding="0"
                                                                                   cellspacing="0"
                                                                                   width="100%">
                                                                                <tr>
                                                                                    <td valign="top"
                                                                                        class="textContent">
                                                                                        <h3 mc:edit="header"
                                                                                            style="color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;">
                                                                                            <strong>Here are things you
                                                                                                may want to
                                                                                                know</strong></h3>
                                                                                        <div mc:edit="body"
                                                                                             style="text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;">
                                                                                            <strong>Event
                                                                                                Coordinator: </strong> {{$user->full_name}}
                                                                                            <br>
                                                                                            <strong>Email
                                                                                                Address: </strong>{{$user->email}}
                                                                                            <br><br>
                                                                                            <strong>Description: </strong> {!!  $event->short_description!!}
                                                                                            <br>
                                                                                            {!! $event->description !!}
                                                                                            <br>
                                                                                            <strong>Event ID
                                                                                                Number: </strong>{{$event->event_number}}
                                                                                            <br>
                                                                                            <strong>Event ID Access
                                                                                                Code: </strong>{{$event->event_code}}
                                                                                            <br>
                                                                                            Payment Method <br>
                                                                                            <ol style="padding-left: 25px">
                                                                                                <li>
                                                                                                    Send me cash or
                                                                                                    check and I will log
                                                                                                    it manually on the
                                                                                                    Event Page
                                                                                                    {{$user->address_1}}
                                                                                                </li>
                                                                                                <li>
                                                                                                    Pay with your PayPal
                                                                                                    Balance through the
                                                                                                    VaultXchange Link
                                                                                                </li>
                                                                                                <li>
                                                                                                    Pay with a Credit
                                                                                                    Card though the
                                                                                                    VaultXchange Link
                                                                                                    which will go right
                                                                                                    to my PayPal account
                                                                                                </li>
                                                                                            </ol>
                                                                                            <br>
                                                                                            <br>
                                                                                            If you use a <strong>Credit Card</strong> to make a
                                                                                            payment there will be a 3.5%
                                                                                            fee added which can be taken
                                                                                            out of the winner’s pool as
                                                                                            well
                                                                                            <br>
                                                                                            <br>
                                                                                            @if($event->vxp_fees)
                                                                                                    Don’t worry about the
                                                                                                VaultX fees, that’s
                                                                                                coming out of the total
                                                                                            @else
                                                                                                    There is very small fee
                                                                                                for using  VaultXchange
                                                                                                to help me, so there
                                                                                                will be a small fee
                                                                                                added if you pay on the
                                                                                                site.   Click here to
                                                                                                see Vault X Fees
                                                                                            @endif
                                                                                            <br>
                                                                                            <br>
                                                                                            @if ($event->allow_anonymous)
                                                                                                You DO NOT need to register with VaultX to make a deposit, although it will make things easier for you
                                                                                            @endif

                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>


                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!-- // FLEXIBLE CONTAINER -->
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- // CENTERING TABLE -->
                                    </td>
                                </tr>
                            </table>
                            <!-- // FLEXIBLE CONTAINER -->
                        </td>
                    </tr>
                </table>
                <!-- // CENTERING TABLE -->
            </td>
        </tr>
        <!-- // MODULE ROW -->


        <!-- MODULE ROW // -->
        <tr>
            <td align="center" valign="top">
                <!-- CENTERING TABLE // -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr style="padding-top:0;">
                        <td align="center" valign="top">
                            <!-- FLEXIBLE CONTAINER // -->
                            <table border="0" cellpadding="30" cellspacing="0" width="500"
                                   class="flexibleContainer">
                                <tr>
                                    <td style="padding-top:0;" align="center" valign="top" width="500"
                                        class="flexibleContainerCell">

                                        <!-- CONTENT TABLE // -->
                                        <table border="0" cellpadding="0" cellspacing="0" width="50%"
                                               class="emailButton" style="background-color: #3498DB;">
                                            <tr>
                                                <td align="center" valign="middle" class="buttonContent"
                                                    style="padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px;">
                                                    <a style="color:#FFFFFF;text-decoration:none;font-family:Helvetica,Arial,sans-serif;font-size:20px;line-height:135%;"
                                                       href="{{route('event.show',$event)}}"
                                                       target="_blank">Event link</a>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- // CONTENT TABLE -->

                                    </td>
                                </tr>
                            </table>
                            <!-- // FLEXIBLE CONTAINER -->
                        </td>
                    </tr>
                </table>
                <!-- // CENTERING TABLE -->
            </td>
        </tr>
        <!-- // MODULE ROW -->


    </table>
@endsection