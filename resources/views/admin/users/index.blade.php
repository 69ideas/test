@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
            {{ link_to_route('admin.user.create', 'New user', [], ['class'=>'btn btn-block btn-success pull-right']) }}
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
                            <th>Name</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Is Admin?</th>
                            <th>City/State</th>
                            <th>Phone</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>@if( $user->is_admin )  <i class="fa fa-check"></i> @else <i class="fa fa-close"></i>@endif</td>
                                <td>{{$user->city ?:'Not set'}}/{{$user->state ?:'Not set'}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.user.show', [$user]) }}"
                                       class="btn btn-xs btn-primary"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Show"
                                    >
                                        <i class="fa fa-desktop"></i>
                                    </a>

                                    {!! Form::open(['route'=>['admin.user.destroy', $user], 'method'=>'DELETE', 'style'=>'display:inline-block'])!!}
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
                                    Users not found
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
                {!! $users->render() !!}
            </div>
        </div>
    </div>

@stop