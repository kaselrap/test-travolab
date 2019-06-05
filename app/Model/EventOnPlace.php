<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EventOnPlace
 * @package App\Model
 */
class EventOnPlace extends Model
{
    use SoftDeletes;

    protected $table = 'event_on_places';

    protected $fillable = [
        'place_id',
        'event_id'
    ];

    public function event()
    {
        return $this->hasOne(Event::class, 'id', 'event_id');
    }
}
