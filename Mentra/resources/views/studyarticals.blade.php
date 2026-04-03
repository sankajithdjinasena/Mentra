@extends('layouts.web')

@section('content')
    <title>Mentra | Study Articals</title>

    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">

    <section class="article-container container sec  wow fadeInDown">
        <h2>Articles on How to Stay Focused While Studying</h2>
        <p>Here are some useful articles that will help you improve focus and stay productive while studying</p>
        @auth
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addArticleModal" style="width: 190px;">
                    + Add Article
                </button>
            </div>
        @endauth
        <ul class="article-list">
            @foreach ($articles as $article)
                <li>
                    <a href="{{ $article['url'] }}" target="_blank">{{ $article['title'] }}</a>
                </li>
            @endforeach
        </ul>
    </section>


  


    @auth
<div class="modal fade" id="addArticleModal" tabindex="-1" aria-labelledby="addArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('articles.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="addArticleModalLabel">Add New Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="title">Article Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter article name" required>
                </div>

                <div class="form-group mb-3">
                    <label for="url">Article URL</label>
                    <textarea name="url" class="form-control" rows="3" placeholder="Enter article URL..." required></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" style="width: 190px;">Submit Article</button>
            </div>
        </form>
    </div>
</div>
@endauth
@endsection
