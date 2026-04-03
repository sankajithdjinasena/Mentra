<?php

namespace App\Http\Controllers;

use App\Models\List_todo;
use App\Models\Study_info;
use App\Models\Todolist;
use Auth;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $todolists = Todolist::where('user_id', Auth::id())
            ->whereDate('date', $date)
            ->with(['listTodos' => function ($query) {
                $query->where('status', 1);
            }])
            ->where('status', '1')
            ->get();


             $userId = Auth::id();
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();

        $studyInfos = Study_info::where('user_id', $userId)
            ->where('status', 1)
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->get()
            ->keyBy('date');

        $dates = collect();
        for ($date = now()->startOfMonth(); $date <= now()->endOfMonth(); $date->addDay()) {
            $dates->put($date->toDateString(), $studyInfos[$date->toDateString()]->hours ?? 0);
        }
        return view('todolist', compact('todolists', 'date','dates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'todos.*' => 'required|string|max:255',
        ]);

        $todolist = Todolist::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
        ]);

        foreach ($request->todos as $todo) {
            List_todo::create([
                'todolist_id' => $todolist->id,
                'todo' => $todo,
            ]);
        }



        return redirect()->route('todolist.index')->with('success', 'To-Do List created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todolist $todolist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todolist $todolist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todolist $todolist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todolist $todolist)
    {
        //
    }

    public function markDone(Request $request, $id)
    {
        $todo = List_todo::findOrFail($id);

        $todo->active_status = $request->is_done;
        $todo->save();

        return response()->json(['success' => true]);
    }


    public function delete($id)
    {
        $todo = List_todo::findOrFail($id);
        $todo->status = 0;
        $todo->save();

        return redirect()->route('todolist.index')->with('success', 'To-Do List Deleted successfully!');
    }

}
