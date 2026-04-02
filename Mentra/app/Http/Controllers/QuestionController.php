<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::latest()->with('user')->get();
        return view('community.index', compact('questions'));
    }

    public function store(Request $request)
    {
        $request->validate(['content' => 'required']);
        Question::create(['user_id' => auth()->id(), 'content' => $request->content]);
        return back()->with('success', 'Question posted!');
    }

    public function show(Question $question)
    {
        $question->load('answers.user');
        return view('community.show', compact('question'));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);

        if (auth()->id() !== $question->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('community.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        if (auth()->id() !== $question->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $question->content = $request->content;
        $question->save();

        return redirect()->route('community')->with('success', 'Question updated successfully!');
    }


}
