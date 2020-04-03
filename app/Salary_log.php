<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary_log extends Model
{
    protected $fillable = ['labour_id','food_rate_date','attendence_number','food_rate_will_get','food_rate_paid','group_id','building_id'];
}
