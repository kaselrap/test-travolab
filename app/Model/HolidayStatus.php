<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HolidayStatus
 * @package App\Model
 */
class HolidayStatus extends Model
{
    use SoftDeletes;

    protected $table = 'holiday_status';

    protected $fillable = [
        'dateStart',
        'dateEnd',
        'reason',
        'work_status_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workStatus()
    {
        return $this->belongsTo(WorkStatus::class, 'work_status_id');
    }
}
