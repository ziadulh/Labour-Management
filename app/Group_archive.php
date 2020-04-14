<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_archive extends Model
{
    protected $fillable = [
        'labour_id', 'group_id', 'building_id', 'attendence_number','food_rate_will_get', 'food_rate_paid', 'food_rate_date',
    ];
}
