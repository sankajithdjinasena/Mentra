<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study_info extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'hours', 'date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
