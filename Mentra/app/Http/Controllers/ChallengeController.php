<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Study_info;
use Illuminate\Http\Request;
use DB;
class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $challenges = Challenge::where('status', 1)->latest()->get();
        return view('admin.viewchallenge', compact('challenges'));
    }



    public function topFocuzers()
{
    $topUsers = Study_info::select('user_id', DB::raw('SUM(hours) as total_hours'))
        ->groupBy('user_id')
        ->orderBy('total_hours', 'desc')
        ->take(10)
        ->with('user')
        ->get();

    return view('topfocuzers', compact('topUsers'));
}

public function showChallenges()
{
    $challenges = Challenge::where('status', 1)->get();
    return view('challenges', compact('challenges'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'type' => 'required',
        ]);

        Challenge::create($request->all());

        return redirect()->route('challenges.create')->with('success', 'Challenge added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Challenge $challenge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Challenge $challenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Challenge $challenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Challenge $challenge,$id)
    {
        $challenge = Challenge::findOrFail($id);
        $challenge->update(['status' => '0']);

        return redirect()->back()->with('success', 'Challenge deleted.');
    }
}
