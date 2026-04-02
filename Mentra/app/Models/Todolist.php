<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'status'];

    public function listTodos()
    {
        return $this->hasMany(List_todo::class);
    }
}
