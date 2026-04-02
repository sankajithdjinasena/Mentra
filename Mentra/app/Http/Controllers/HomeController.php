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
