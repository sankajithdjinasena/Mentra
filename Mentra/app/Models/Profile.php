<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  protected $fillable = [
    'user_id', 'age', 'gender', 'heart_rate', 'bmi_category', 
    'systolic_bp', 'diastolic_bp', 'quality_of_sleep', 
    'physical_activity_level', 'stress_level'
];
}
