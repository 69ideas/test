@extends('frontend.layout')
@section('content')
    <div class="row form-group" align="center">
        <h1>Member page</h1>
        <hr style="border: none; /* Убираем границу */
    background-color: #bb0000; /* Цвет линии */
    color: #bb0000; /* Цвет линии для IE6-7 */
    height: 5px;">
    </div>
    <div class="row form-group">
        <div class="col-sm-4">
            {{ link_to_route('profile', 'Edit Profile', [], ['class'=>'btn btn-block btn-success pull-right','data-toggle'=>"tooltip", 'data-placement'=>"top",'title'=>'You can edit your Profile by clicking here ']) }}
        </div>
        <div class="col-sm-4 ">
        </div>
        @if(\Auth::user()->isFeePay())
            <div class="col-sm-4 ">
                {{ link_to_route('event.create', 'Create New Event', [], ['class'=>'btn btn-block btn-success pull-right','data-toggle'=>"tooltip", 'data-placement'=>"top",'title'=>'You can create a new Event by clicking here']) }}
            </div>
            @else
            <div class="col-sm-4 ">
                <a href="#" class='btn btn-block btn-success pull-right' data-toggle="tooltip" data-placement="top" disabled="" title='You need to clear outstanding balance before you can create new event'>Create New Event</a>
            </div>
        @endif

    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row" align="center">
        <h4>Your events</h4>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @include('admin.validation.all')
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="searchable table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Click to go to event"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>

                    </th>
                    <th>Short Description
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Short Description"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </th>
                    <th>Total Collected
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Total Collected"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </th>
                    <th>Total Contributed by user
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Total Contributed by user"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </th>
                    <th>Start Date
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Date event will be started."
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </th>
                    <th>Close Date
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="This is a suggested date.  The Event will not automatically close after the date, nor will it keep a participant from being able to make a payment"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </th>
                    <th>Action</th>
                    <th>Info about outstanding payment</th>
                </tr>
                </thead>
                <tbody>
                @forelse($events as $event)
                    @if (count($event->participants()->where('user_id',\Auth::user()->id)->get()) || $event->user_id==\Auth::user()->id)
                        <tr>
                            <td>
                                @if(!is_null($event->closed_date))
                                    <a href="{{ route('event.show', $event) }}"> <span
                                                class="label label-danger"> @if (isset($event->event_number)) {{$event->event_number}} @else {{$event->id}} @endif  </span></a>
                                @else
                                    <a href="{{ route('event.show', $event) }}"> <span
                                                class="label label-success">@if (isset($event->event_number)) {{$event->event_number}} @else {{$event->id}} @endif  </span></a>
                                @endif
                            </td>
                            <td>{{ $event->short_description }}</td>
                            <td>${{ number_format($event->total, 2) }}</td>
                            <td>${{ number_format($event->current_user_collected, 2) }}</td>
                            <td>@if(isset($event->start_date)){{ $event->start_date->format('m/d/Y')}} @endif</td>
                            <td>@if(isset($event->closed_date)){{ $event->closed_date->format('m/d/Y')}} @else
                                    Open @endif</td>
                            <td>
                                @if ($event->user_id==\Auth::user()->id)
                                    <a href="{{ route('event.edit', $event) }}"
                                       class="btn btn-xs btn-primary"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Edit" style="background: #49658A;"
                                    >
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    @if(\Auth::user()!=null)
                                        @if($event->payment==null)
                                            @if(\Auth::user()->id==$event->user_id)
                                                <a href="{{ route('pay_fee', $event) }}"
                                                   class="btn btn-xs btn-success"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="Pay Fees"
                                                >
                                                    <i class="fa fa-dollar"></i>
                                                </a>
                                            @endif

                                        @elseif($event->payment->status!='Completed' && $event->payment->status!='Pending')
                                            @if(\Auth::user()->id==$event->user_id)
                                                <a href="{{ route('pay_fee', $event) }}"
                                                   class="btn btn-xs btn-success"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="Pay Fees"
                                                >
                                                    <i class="fa fa-dollar"></i>
                                                </a>
                                            @endif
                                        @endif
                                    @endif


                                @endif

                            </td>
                            <td> @if(\Auth::user()!=null)
                                    @if(\Auth::user()->id==$event->user_id)
                                        @if (isset($event->payment )){{$event->payment->status}}
                                        @else Not paid yet
                                        @endif
                                    @endif
                                     @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr class="bg-info">
                        <td colspan="7" class="text-center text-bold">
                            Events not found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection