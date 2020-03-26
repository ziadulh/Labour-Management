<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labour extends Model
{
    protected $fillable = [
        'name','joining_date','labour_type','group_id','building_id','attendance_rate','food_rate', 'total_food_rate', 'due_foodrate','total_attendance','total_salary','total_paid','total_due', 'status', 'created_by', 'updated_by'
    ];
}
