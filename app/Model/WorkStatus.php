<?php

namespace App\Model;

use App\Services\Debug;
use App\Traits\Data;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkStatus extends Model
{
    use SoftDeletes,
        Data;

    protected $table = 'work_statuses';

    protected $fillable = [
        'employee_id',
        'date_start',
        'date_end',
        'data',
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function times()
    {
        return $this->hasManyThrough(Time::class, StatusInTime::class, 'status_id', 'id', 'id', 'time_id');
    }

    public function getTimeStart()
    {
        return $this->getData('time_start') ?: '';
    }

    public function getTimeEnd()
    {
        return $this->getData('time_end') ?: '';
    }

    public function getPeriod()
    {
        return $this ? implode(' - ', [$this->getTimeStart(), $this->getTimeEnd()]) : '';
    }
}
