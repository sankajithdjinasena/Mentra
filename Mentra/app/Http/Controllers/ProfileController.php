<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show()
    {
        $user = Auth::user();
        $courses = $user->courses ?? []; 

        if ($user->role === 'admin') { 
            return redirect()->route('admin.dashboard');
        }

        $profile = $user->profile ?? new Profile();
        return view('profile', compact('user', 'profile','courses'));
    }





    public function storeOrUpdate(Request $request)
    {
        $data = $request->validate([
            'age' => 'required|integer',
            'gender' => 'required',
            'heart_rate' => 'required|integer',
            'bmi_category' => 'required',
            'systolic_bp' => 'required|integer',
            'diastolic_bp' => 'required|integer',
            'quality_of_sleep' => 'required|integer|between:1,10',
            'physical_activity_level' => 'required|integer',
            'stress_level' => 'required|integer|between:1,10',
        ]);

        Auth::user()->profile()->updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

        return back()->with('success', 'Profile updated successfully!');
    }
    
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
