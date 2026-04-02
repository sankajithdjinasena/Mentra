<?php

namespace App\Http\Controllers;
use App\Mail\ReminderEmail;
use Auth;
use App\Models\Reminder;
// use Illuminate\Support\Carbon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReminderController extends Controller
{
    public function index()
    {
        // $reminders = Reminder::where('user_id', Auth::id())
        //     ->where(function ($query) {
        //         $query->where('date', '>', now()->toDateString())
        //             ->orWhere(function ($q) {
        //                 $q->where('date', now()->toDateString())
        //                   ->where('time', '>', now()->toTimeString());
        //             });
        //     })
        //     ->where('status', '1')
        //     ->orderBy('date')
        //     ->orderBy('time')
        //     ->get();


        $now = Carbon::now('Asia/Colombo')->toDateTimeString();

        $reminders = Reminder::where('user_id', Auth::id())
            ->where('status', '1')
            ->whereRaw("STR_TO_DATE(CONCAT(date, ' ', time), '%Y-%m-%d %H:%i:%s') > ?", [$now])
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        // dd($reminders );

        return view('reminders', compact('reminders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'reminder' => 'required|string|max:255'
        ]);

        $reminder = Reminder::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'time' => $request->time,
            'reminder' => $request->reminder
        ]);



        $reminderTime = Carbon::createFromFormat('Y-m-d H:i', "{$request->date} {$request->time}", 'Asia/Colombo');
        $currentTime = Carbon::now('Asia/Colombo');

        $minutesDifference = $currentTime->diffInMinutes($reminderTime, false);

        $reminderTime = now()->addMinutes($minutesDifference);


        Mail::to(Auth::user()->email)
            ->later($reminderTime, new ReminderEmail($reminder));


        return redirect()->route('reminders.index')->with('success', 'Reminder added successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Reminder $reminder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reminder $reminder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reminder $reminder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reminder = Reminder::findOrFail($id);
        $reminder->status = 0;
        $reminder->save();

        $jobs = \DB::table('jobs')->get();

        foreach ($jobs as $job) {
            $payload = json_decode($job->payload, true);
            if (strpos($job->payload, '"id\";i:' . $id) !== false) {
                \DB::table('jobs')->where('id', $job->id)->delete();
            }
        }
        return redirect()->route('reminders.index')->with('success', 'Reminder deleted successfully.');
    }

}
