@extends('admin.layout')

@section('content')

    <div class="row">
        @if(count($photos)<3)
        <div class="col-sm-4 col-sm-offset-8">
            {{ link_to_route('admin.photo.create', 'New Photo', [], ['class'=>'btn btn-block btn-success pull-right']) }}
        </div>
        @endif
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
                            <th>Name</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        @forelse($photos as $photo)
                            <tr>
                                <td>{{ $photo->name }}</td>
                                <td>{{ $photo->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.photo.edit', [$photo]) }}"
                                       class="btn btn-xs btn-primary"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Edit"
                                            >
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    {!! Form::open(['route'=>['admin.photo.destroy', $photo], 'method'=>'DELETE', 'style'=>'display:inline-block'])!!}
                                    <button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                            title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    {!! Form::close() !!}

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="bg-info text-center text-bold">
                                    Images not found
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
                {!! $photos->render() !!}
            </div>
        </div>
    </div>

@stop