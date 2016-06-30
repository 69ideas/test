@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
            {{ link_to_route('admin.article.create', 'New Article', [], ['class'=>'btn btn-block btn-success pull-right']) }}
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
                            <th>Anons</th>
                            <th>Published Date</th>
                            <th>Actions</th>
                        </tr>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ str_limit(strip_tags($article->text)) }}</td>
                                <td>{{ $article->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.article.edit', [$article]) }}"
                                       class="btn btn-xs btn-primary"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Edit"
                                            >
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <a href="{{ route('admin.article.destroy', [$article]) }}"
                                       class="btn btn-xs btn-danger"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Delete"
                                            >
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="bg-info text-center text-bold">
                                    Articles not found
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
                {!! $articles->render() !!}
            </div>
        </div>
    </div>

@stop