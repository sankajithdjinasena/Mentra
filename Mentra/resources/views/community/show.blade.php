@extends('layouts.web')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/community.css') }}">

    <div class="max-w-4xl mx-auto p-4  container sec">
        <a href="{{ route('community') }}" class="back-link">← Go Back to Study Community</a>


        <h2 class="text-2xl font-bold">{{ $question->content }}</h2>
        <p class="text-sm text-gray-500 mb-6">Asked by {{ $question->user->name }}</p>

        <hr>



        {{-- Answers List --}}
        <h3 class="text-lg font-semibold mb-3">Answers</h3>
        @forelse ($question->answers as $answer)
            <div class="mb-4 p-3 border rounded answer-card" >
                <p style="font-style: italic">"{{ $answer->content }}"</p>
                <p class="question-meta">Answered by {{ $answer->user->name }} on {{ $answer->created_at->format('M d, Y') }}</p>
            </div>
        @empty
            <p class="text-gray-500">No answers yet.</p>
        @endforelse


          <hr>

        {{-- Answer Form --}}
        <h3 class="text-lg font-semibold mt-6">Your Answer</h3>
        <form action="{{ route('answers.store', $question->id) }}" method="POST" class="mb-6">
            @csrf
            <textarea name="content" rows="4" class="w-full border p-2 rounded" placeholder="Write your answer..."></textarea>
            <button class="btn-submit" type="submit">Submit Answer</button>
        </form>


    </div>
@endsection
