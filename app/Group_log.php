<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_log extends Model
{
    protected $fillable = [
        'group_id', 'payment_date', 'description', 'total_amount','total_paid', 'total_due', 'last_paid',
    ];
}
