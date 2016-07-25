@extends('frontend.emails.layout')
@section('content')
<table bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="500" id="emailBody">

    <!-- MODULE ROW // -->
    <!--
        To move or duplicate any of the design patterns
        in this email, simply move or copy the entire
        MODULE ROW section for each content block.
    -->
    <tr>
        <td align="center" valign="top">
            <!-- CENTERING TABLE // -->
            <!--
                The centering table keeps the content
                tables centered in the emailBody table,
                in case its width is set to 100%.
            -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="color:#FFFFFF;"
                   bgcolor="#3498db">
                <tr>
                    <td align="center" valign="top">
                        <!-- FLEXIBLE CONTAINER // -->
                        <!--
                            The flexible container has a set width
                            that gets overridden by the media query.
                            Most content tables within can then be
                            given 100% widths.
                        -->
                        <table border="0" cellpadding="0" cellspacing="0" width="500"
                               class="flexibleContainer">
                            <tr>
                                <td align="center" valign="top" width="500"
                                    class="flexibleContainerCell">

                                    <!-- CONTENT TABLE // -->
                                    <!--
                                    The content table is the first element
                                        that's entirely separate from the structural
                                        framework of the email.
                                    -->
                                    <table border="0" cellpadding="30" cellspacing="0" width="100%">
                                        <tr>
                                            <td align="center" valign="top" class="textContent">
                                                <h1 style="color:#FFFFFF;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px;text-align:center;">
                                                    Hello, @if($user->first_name!=''){{$user->first_name}} @else {{strtoupper($user->email)}} @endif  </h1>
                                                <h2 style="text-align:center;font-weight:normal;font-family:Helvetica,Arial,sans-serif;font-size:23px;margin-bottom:10px;color:#205478;line-height:135%;">
                                                    Event: {{$event->short_description}}</h2>
                                                <div style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:135%;">
                                                    Event Coordinator: {{$event->user->full_name}}
                                                    <br>
                                                    Coordinar's Email:{{$event->user->email}}</div>
                                                    <br>
                                                    The Event Number: {{$event->event_number}}
                                                    <br>
                                                    The Event Access Code: {{$event->event_code}}
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


    <!-- MODULE ROW // -->
    <!--  The "mc:hideable" is a feature for MailChimp which allows
        you to disable certain row. It works perfectly for our row structure.
        http://kb.mailchimp.com/article/template-language-creating-editable-content-areas/
    -->
    <tr mc:hideable>
        <td align="center" valign="top">
            <!-- CENTERING TABLE // -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="center" valign="top">
                        <!-- FLEXIBLE CONTAINER // -->
                        <table border="0" cellpadding="30" cellspacing="0" width="500"
                               class="flexibleContainer">
                            <tr>
                                <td align="center" valign="top">
                                    <!-- CENTERING TABLE // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                           bgcolor="#F8F8F8">
                                        <tr>
                                            <td align="center" valign="top">
                                                <!-- FLEXIBLE CONTAINER // -->
                                                <table border="0" cellpadding="0" cellspacing="0"
                                                       width="500" class="flexibleContainer">
                                                    <tr>
                                                        <td align="center" valign="top" width="500"
                                                            class="flexibleContainerCell">
                                                            <table border="0" cellpadding="30"
                                                                   cellspacing="0" width="100%">
                                                                <tr>
                                                                    <td align="center" valign="top">

                                                                        <!-- CONTENT TABLE // -->
                                                                        <table border="0"
                                                                               cellpadding="0"
                                                                               cellspacing="0"
                                                                               width="100%">
                                                                            <tr>
                                                                                <td valign="top"
                                                                                    class="textContent">
                                                                                    <!--
                                                                                        The "mc:edit" is a feature for MailChimp which allows
                                                                                        you to edit certain row. It makes it easy for you to quickly edit row sections.
                                                                                        http://kb.mailchimp.com/templates/code/create-editable-content-areas-with-mailchimps-template-language
                                                                                    -->
                                                                                    <h3 mc:edit="header"
                                                                                        style="color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;">{{$event->short_description}}</h3>
                                                                                    <div mc:edit="body"
                                                                                         style="text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;">

                                                                                        Description: {!!  $event->description!!}
                                                                                        <br>
                                                                                        Event
                                                                                        Coordinator: {{$event->user->full_name}}
                                                                                        <br>
                                                                                        Coordinar's
                                                                                        Email:{{$event->user->email}}
                                                                                        <br>
                                                                                        Start
                                                                                        date: {{$event->start_date->format('m/d/Y')}}
                                                                                        <br>
                                                                                        Deadline:{{$event->deadline->format('m/d/Y')}}
                                                                                        <br>
                                                                                        Amount per
                                                                                        person: {{number_format($event->needable_sum,2)}}
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <!-- // CONTENT TABLE -->

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
                                                   target="_blank">Go to the Event</a>
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