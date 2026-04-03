@extends('layouts.web')

@section('content')
    <div class="max-w-2xl mx-auto p-4 container sec">
        <h2 class="text-xl font-bold mb-4">Edit Your Question</h2>

        <form action="{{ route('questions.update', $question->id) }}" method="POST">
            @csrf
            @method('PUT')
            <textarea name="content" rows="5" class="w-full p-2 border rounded">{{ old('content', $question->content) }}</textarea>
            <button type="submit" class="btn-submit mt-2">Update Question</button>
        </form>
    </div>
@endsection
