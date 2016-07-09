@extends('frontend.layout')
@section('content')

    <div class="row">
        <div class="col-sm-4">
            {{ link_to_route('profile', 'Edit Profile', [], ['class'=>'btn btn-block btn-success pull-right','data-toggle'=>"tooltip", 'data-placement'=>"top",'title'=>'You can edit your Profile by clicking here ']) }}
        </div>
        <div class="col-sm-4 ">
        </div>
        <div class="col-sm-4 ">
            {{ link_to_route('event.create', 'Create New Event', [], ['class'=>'btn btn-block btn-success pull-right','data-toggle'=>"tooltip", 'data-placement'=>"top",'title'=>'You can create a new Event by clicking here']) }}
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <div class="col-sm-12">
            @include('admin.validation.all')
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-striped">
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
                            <th>Short Description</th>
                            <th>Total Collected</th>
                            <th>Total Contributed by user</th>
                            <th>Start Date</th>
                            <th>Close Date</th>
                            <th>Action</th>
                        </tr>
                        @forelse($events as $event)
                            @if (count($event->participants()->where('user_id',\Auth::user()->id)->get()) || $event->user_id==\Auth::user()->id)
                                <tr>
                                    <td>
                                        @if($event->is_close)
                                            <a href="{{ route('event.show', $event) }}"> <span
                                                        class="label label-danger"> @if (isset($event->event_number)) {{$event->event_number}} @else {{$event->id}} @endif  </span></a>
                                        @else
                                            <a href="{{ route('event.show', $event) }}"> <span
                                                        class="label label-success">@if (isset($event->event_number)) {{$event->event_number}} @else {{$event->id}} @endif  </span></a>
                                        @endif
                                    </td>
                                    <td>{{ $event->short_description }}</td>
                                    <td>{{ number_format($event->total, 2) }}</td>
                                    <td>{{ number_format($event->current_user_collected, 2) }}</td>
                                    <td>@if(isset($event->start_date)){{ $event->start_date->format('d/m/Y')}} @endif</td>
                                    <td>@if(isset($event->closed_date)){{ $event->closed_date->format('d/m/Y')}} @else
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
                                        @endif

                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="7" class="bg-info text-center text-bold">
                                    Events not found
                                </td>
                            </tr>
                        @endforelse
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="pull-right">
                {!! $events->render() !!}
            </div>
        </div>
    </div>

@endsection