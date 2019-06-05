<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EventCoast
 * @package App\Model
 */
class EventCoast extends Model
{
    use SoftDeletes;

    protected $table = 'events_coast';

    protected $fillable = [
        'coast_less_five_spec',
        'coast_less_five_other',
        'coast_more_five_spec',
        'coast_more_five_other',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * @return string
     */
    public function getEventName()
    {
        $event = $this->event;

        return $event ? $event->name : '';
    }
}
