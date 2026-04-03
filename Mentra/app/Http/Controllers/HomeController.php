<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Feedback;
use App\Models\Study_info;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function dash_user()
    {
        $users = User::where('status', 1)->get();
        return view('admin.viewusers', compact('users'));
    }
  
        public function dash_top()
    {
        $topUsers = Study_info::select('user_id', DB::raw('SUM(hours) as total_hours'))
            ->groupBy('user_id')
            ->orderBy('total_hours', 'desc')
            ->take(10)
            ->with('user')
            ->get();

        return view('admin.topusers', compact('topUsers'));
    }
    public function dash_feedbacks()
    {
        $feedbacks = Feedback::latest()->get();
        return view('admin.dashfeedback', compact('feedbacks'));
    }

    public function dash_challenge()
    {
        return view('admin.challenge');
    }



    public function dashboard()
    {
        $userCount = User::count();
        $totalStudyHours = Study_info::sum('hours');
        $activeChallenges = Challenge::where('status',1)->count();
        $feedbackCount = Feedback::count();

        return view('admin.dashboard', compact(
            'userCount',
            'totalStudyHours',
            'activeChallenges',
            'feedbackCount'
        ));
    }
}
