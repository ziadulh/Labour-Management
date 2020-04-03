<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary_Based_Employee extends Model
{
    protected $fillable = [
        'name','building_id','group_id','salary','status', 'created_by', 'updated_by'
    ];
}
