<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusInTime extends Model
{
    use SoftDeletes;

    protected $table = 'status_in_times';

    protected $fillable = [
        'status_id',
        'time_id',
    ];
}
