<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = [
        'name', 'group_id', 'status', 'created_by', 'updated_by'
    ];
}
