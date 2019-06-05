<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Time extends Model
{
    use SoftDeletes;

    protected $table = 'times';

    protected $fillable = [
        'time_start',
        'time_end',
        'type_time',
    ];

    public function getTimeStart()
    {
        return $this->getAttribute('time_start') ?: '';
    }

    public function getTimeEnd()
    {
        return $this->getAttribute('time_end') ?: '';
    }

    public function getPeriod()
    {
        return $this ? implode(' - ', [$this->getTimeStart(), $this->getTimeEnd()]) : '';
    }
}
