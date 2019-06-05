<?php

namespace App\Model;

use App\Services\Debug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treatie extends Model
{
    use SoftDeletes;

    protected $table = 'treaties';

    protected $fillable = [
        'reservation_id',
        'event_on_place_id',
        'exit_date',
        'time_start',
        'time_end',
        'subtype_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function event()
    {
        return $this->hasOne(EventOnPlace::class, 'id', 'event_on_place_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function place()
    {
        return $this->hasManyThrough(Place::class, EventOnPlace::class, 'id', 'id', 'event_on_place_id', 'place_id');
    }

    /**
     * @return string
     */
    public function getPlaceName()
    {
        $place = $this->place->first();
        if ($place) {
            return $place->name;
        }

        return '';
    }
}
