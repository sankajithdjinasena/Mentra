<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  protected $fillable = ['user_id', 'subject_name', 'result'];
}
