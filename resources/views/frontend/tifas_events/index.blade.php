@extends('frontend.layout')
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
                            <tr>
                                <td colspan="7" class="bg-info text-center text-bold">
                                    Here will be your events
                                </td>
                            </tr>
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