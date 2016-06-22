@extends('frontend.index')
@section('content')

    <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
            {{ link_to_route('event.create', 'New event', [], ['class'=>'btn btn-block btn-success pull-right']) }}
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
                            <th>ID</th>
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Deadline</th>
                            <th>Allow Anonymous?</th>
                            <th>Action</th>
                        </tr>
                        @forelse($events as $event)
                            <tr>
                                <td>@if($event->is_close)<span class="label label-danger">{{ $event->id }}</span> @else
                                        <span class="label label-success">{{ $event->id }}</span>@endif</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->short_description }}</td>
                                <td>@if(isset($event->deadline)){{ $event->deadline->format('d/m/Y')}}@endif</td>
                                <td>@if( $event->allow_anonymous)  <i
                                            class="fa fa-check"></i> @else <i class="fa fa-close"></i>@endif</td>
                                <td>
                                    <a href="{{ route('event.show', $event) }}"
                                       class="btn btn-xs btn-success"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Show&Add Participant"
                                    >
                                        <i class="fa fa-desktop"></i>
                                    </a>
                                    <a href="{{ route('event.edit', $event) }}"
                                       class="btn btn-xs btn-primary"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Edit"
                                    >
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                </td>
                            </tr>
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