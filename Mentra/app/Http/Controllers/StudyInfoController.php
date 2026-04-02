<?php

namespace App\Http\Controllers;
use App\Models\Badge;
use DB;
use App\Models\Study_info;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class StudyInfoController extends Controller
{
    public function index()
    {
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

        return view('studyinfo', compact('dates'));
    }





    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'hours' => 'required',
    //         'date' => 'required|date',
    //     ]);

    //     $userId = Auth::id();
    //     $existingRecord = Study_info::where('user_id', $userId)
    //         ->where('date', $request->date)
    //         ->first();

    //     if ($existingRecord) {
    //         $existingRecord->update([
    //             'hours' => $request->hours,
    //         ]);
    //     } else {
    //         Study_info::create([
    //             'user_id' => $userId,
    //             'hours' => $request->hours,
    //             'date' => $request->date,
    //         ]);
    //     }

    //     $totalHours = Study_info::where('user_id', $userId)->where('date', $request->date)->sum('hours');

    //     $badge = Badge::where('status', 1)
    //         ->where('hours', '<=', $totalHours)
    //         // ->whereNotIn('id', function ($query) use ($userId) {
    //         //     $query->select('badge_id')
    //         //         ->from('user_badges')
    //         //         ->where('user_id', $userId);
    //         // })
    //         ->orderBy('hours', 'desc')
    //         ->first();

    //     if ($badge) {
    //         $existingBadge = DB::table('user_badges')
    //             ->where('user_id', $userId)
    //             ->whereDate('awarded_at', now()->toDateString()) // Check for same date
    //             ->first();

    //         if ($existingBadge) {
    //             DB::table('user_badges')
    //                 ->where('id', $existingBadge->id)
    //                 ->update([
    //                     'badge_id' => $badge->id,
    //                     'awarded_at' => now(),
    //                 ]);
    //         } else {
    //             DB::table('user_badges')->insert([
    //                 'user_id' => $userId,
    //                 'badge_id' => $badge->id,
    //                 'awarded_at' => now(),
    //             ]);
    //         }

    //         return redirect()->route('studyinfo.index')
    //             ->with('success', 'Study info saved successfully!')
    //             ->with('badge', $badge);
    //     }

    //     return redirect()->route('studyinfo.index')->with('success', 'Study info saved successfully!');
    // }





    public function store(Request $request)
    {
        $request->validate([
            'hours' => 'required|numeric|min:0.1',
            'date' => 'required|date',
        ]);

        $userId = Auth::id();

        $existingRecord = Study_info::where('user_id', $userId)
            ->where('date', $request->date)
            ->first();

        if ($existingRecord) {
            $existingRecord->update([
                'hours' => $request->hours,
            ]);
        } else {
            Study_info::create([
                'user_id' => $userId,
                'hours' => $request->hours,
                'date' => $request->date,
            ]);
        }

        $totalHours = Study_info::where('user_id', $userId)
            ->where('date', $request->date)
            ->sum('hours');

        $badge = Badge::where('status', 1)
            ->where('hours', '<=', $totalHours)
            ->orderBy('hours', 'desc')
            ->first();

        if ($badge) {
            $existingBadge = DB::table('user_badges')
                ->where('user_id', $userId)
                ->whereDate('awarded_at', now()->toDateString())
                ->first();

            if ($existingBadge) {
                DB::table('user_badges')
                    ->where('id', $existingBadge->id)
                    ->update([
                        'badge_id' => $badge->id,
                        'awarded_at' => now(),
                    ]);
            } else {
                DB::table('user_badges')->insert([
                    'user_id' => $userId,
                    'badge_id' => $badge->id,
                    'awarded_at' => now(),
                ]);
            }
        }

        try {
            // $response = Http::get('http://127.0.0.1:5000/motivate', [
            //     'minutes' => $totalHours * 60
            // ]);

              $response = Http::get('https://focuszen-motivation.onrender.com/motivate', [
                'minutes' => $totalHours * 60
            ]);



            $motivation = $response->successful()
                ? $response->json()['message'] ?? 'Keep going!'
                : 'Stay strong and focused!';
        } catch (\Exception $e) {
            $motivation = 'You are doing great! Keep it up!';
        }

        return redirect()->route('studyinfo.index')
            ->with('success', 'Study info saved successfully!')
            ->with('badge', $badge)
            ->with('motivation', $motivation);
    }




    public function show(Study_info $study_info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Study_info $study_info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Study_info $study_info)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Study_info $study_info)
    {
        //
    }





    public function progressindex()
    {
        $userId = Auth::id();
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();

        $studyInfos = Study_info::where('user_id', $userId)
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->get()
            ->keyBy('date');

        $dates = collect();
        for ($date = now()->startOfMonth(); $date <= now()->endOfMonth(); $date->addDay()) {
            $dates->put($date->toDateString(), $studyInfos[$date->toDateString()]->hours ?? 0);
        }

        $dateLabels = $dates->keys()->toArray();
        $studyHours = $dates->values()->toArray();

        $monthlyProgress = Study_info::where('user_id', $userId)
            ->selectRaw('MONTH(date) as month, SUM(hours) as total_hours')
            ->whereYear('date', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $monthLabels = collect(range(1, 12))->map(function ($month) {
            return now()->startOfYear()->addMonths($month - 1)->format('F');
        })->toArray();

        $monthlyHours = collect(range(1, 12))->map(function ($month) use ($monthlyProgress) {
            return $monthlyProgress[$month]->total_hours ?? 0;
        })->toArray();

        $badges = DB::table('user_badges')
            ->join('badges', 'user_badges.badge_id', '=', 'badges.id')
            ->where('user_badges.user_id', $userId)
            ->select('badges.badge_name as badge_name', DB::raw('COUNT(user_badges.id) as earn_count'))
            ->groupBy('badges.badge_name')
            ->get();

        return view('studyprogress', compact('dateLabels', 'studyHours', 'monthLabels', 'monthlyHours', 'badges'));
    }





}
