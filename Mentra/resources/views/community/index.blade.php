@extends('layouts.web')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/community.css') }}">

    <div class="row flex container sec">
        <div class="col-md-6 border-r communityhead">
            <h2 class="text-xl font-bold mb-3">Community Questions</h2>

            @foreach ($questions as $question)
                <div class="mb-3">
                    <a href="{{ route('questions.show', $question->id) }}" class="question-link">
                        {{ $question->content }}
                    </a>
                    <p class="text-sm text-gray-500 q-ask">
                        Asked by {{ $question->user->name }} &nbsp;
                        @auth
                            @if (auth()->id() === $question->user_id)
                                <button class="btn btn-link text-green-400 text-sm ml-2 p-0" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $question->id }}">
                                    <i class="fa fa-edit me-1 edit-com"  title="Edit this question"></i>
                                </button>
                            @endif
                        @endauth
                    </p>
                </div>

                <div class="modal fade" id="editModal{{ $question->id }}" tabindex="-1"
                    aria-labelledby="editModalLabel{{ $question->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('questions.update', $question->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $question->id }}">Edit Your Question</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <textarea name="content" rows="4" class="form-control">{{ old('content', $question->content) }}</textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="col-md-6 ">
            <h2 class="text-xl font-bold mb-4">Ask a Question</h2>
            <form action="{{ route('questions.store') }}" method="POST">
                @csrf
                <textarea name="content" rows="5" class="w-full p-2 border rounded" placeholder="Type your question..."></textarea>
                <button type="submit" class="btn-submit">Submit</button>

            </form>
        </div>
    </div>
@endsection
