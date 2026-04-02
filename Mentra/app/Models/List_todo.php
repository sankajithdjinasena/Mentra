<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class List_todo extends Model
{
    use HasFactory;

    protected $fillable = ['todolist_id', 'todo', 'active_status', 'status'];

    public function todolist()
    {
        return $this->belongsTo(Todolist::class);
    }
}
