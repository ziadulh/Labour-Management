<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary_Based_log extends Model
{
    protected $fillable = ['salary','employee_id','month','building_id','group_id',];
}
