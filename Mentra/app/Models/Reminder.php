<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'date', 'time', 'reminder', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retrieve reminders for the current authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function forCurrentUser()
    {
        $now = Carbon::now('Asia/Colombo')->toDateTimeString();

        return self::where('user_id', auth()->id())
            ->where('status', '1')
            ->whereRaw("STR_TO_DATE(CONCAT(date, ' ', time), '%Y-%m-%d %H:%i:%s') > ?", [$now])
            ->orderBy('date')
            ->orderBy('time')
            ->get();
    }
}
