@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1 class="text-center mb-4">Edit Article</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Article</h3>
                </div>

                <form action="{{ route('Article.update', $article->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Article Title</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ $article->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="url">Article URL</label>
                            <textarea name="url" class="form-control" rows="3" required>{{ $article->url }}</textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Article</button>
                        <a href="{{ route('Article.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
