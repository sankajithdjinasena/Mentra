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

        if ($user->status === 2) { 
            return redirect()->route('dashboard');
        }

        $profile = $user->profile ?? new Profile();
        return view('profile', compact('user', 'profile','courses'));
    }





    public function storeOrUpdate(Request $request)
    {

        $data = $request->validate([
            'mobile' => 'nullable|max:15',
            'age' => 'nullable|integer',
            'gender' => 'nullable',
            'heart_rate' => 'nullable|integer',
            'bmi_category' => 'nullable',
            'systolic_bp' => 'nullable|integer',
            'diastolic_bp' => 'nullable|integer',
            'quality_of_sleep' => 'nullable|integer|between:1,10',
            'physical_activity_level' => 'nullable|integer',
            'stress_level' => 'nullable|integer|between:1,10',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        // Auth::user()->profile()->updateOrCreate(
        //     ['user_id' => Auth::id()],
        //     $data
        // );

        $user = Auth::user();
        $profile = $user->profile;

        if ($request->hasFile('profile_image')) {
            if ($profile && $profile->profile_image) {
                Storage::disk('public')->delete($profile->profile_image);
            }
            
            $path = $request->file('profile_image')->store('profiles', 'public');
            $data['profile_image'] = $path;
        }

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
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
