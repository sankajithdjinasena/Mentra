@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1 style="text-align:center;" class="mb-5">Study Articles</h1>

        @if (session('success'))
            <div class=" col-md-10 offset-md-1  alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="col-md-10 offset-md-1 card">


            <div class="card-body">
                @if ($articles->count())
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Article Title</th>
                                <th>Article URL</th>
                                <th>Actions</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td>{{ $article->id }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td>
                                        <a href="{{ $article->url }}" target="_blank">{{ $article->url }}</a>
                                    </td>
                                    <td>


                                        <a href="{{ route('Article.edit', $article->id) }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>


                                    </td>

                                    <td>
                                        @if ($article->status == 1)
                                            <form action="{{ route('Article.destroy', $article->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this article?')">
                                                    Delete
                                                </button>
                                            </form>
                                       @endif
                                         @if ($article->status == 0)
                                            <form action="{{ route('Article.restore', $article->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm"
                                                    onclick="return confirm('Are you sure you want to restore this article?')">
                                                    Restore
                                                </button>
                                            </form>
                                        @endif

                                        @if ($article->status == 2)
                                            <form action="{{ route('Article.approve', $article->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm"
                                                    onclick="return confirm('Are you sure you want to approve this article?')">
                                                    Approve
                                                </button>
                                            </form>
                                        @elseif ($article->status == 3)
                                            <form action="{{ route('Article.unapprove', $article->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to unapprove (delete) this article?')">
                                                    Unapprove
                                                </button>
                                            </form>
                                        @endif
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No articles found.</p>
                @endif
            </div>
        </div>
    </section>
@endsection
