@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1 style="text-align:center;" class="mb-5">Study Articles</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Add New Article</h3>
                </div>
                <form action="{{ route('Article.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Article Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Article name" required>
                        </div>

                        <div class="form-group">
                            <label for="url">Article Url</label>
                            <textarea name="url" class="form-control" rows="3" placeholder="Enter Article Url..." required></textarea>
                        </div>


                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Add Article</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
