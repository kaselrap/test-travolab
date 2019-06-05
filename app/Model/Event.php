<?php

namespace App\Model;

use App\Services\Debug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Event
 * @package App\Model
 */
class Event extends Model
{
    use SoftDeletes;
    
    protected $table = 'events';
    
    protected $fillable = [
        'name',
        'duration',
        'subtype_id'
    ];

    /**
     * @return int|string
     */
    public function getEventOnPlaceId()
    {
        $eventOnPlace = $this->eventOnPlace;

        return $eventOnPlace ? $eventOnPlace->id : '';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function eventOnPlace()
    {
        return $this->hasOne(EventOnPlace::class, 'event_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subtype()
    {
        return $this->hasOne(Subtype::class, 'id', 'subtype_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function places()
    {
        return $this->belongsToMany(Place::class, 'event_on_places', 'event_id', 'place_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function treaties()
    {
        return $this->hasManyThrough(Treatie::class, EventOnPlace::class, 'event_id', 'event_on_place_id', 'id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function eventCoast()
    {
        return $this->hasOne(EventCoast::class, 'event_id', 'id');
    }

    /**
     * @return mixed
     */
    public static function getListForEventCoast()
    {
        $eventCostId = EventCoast::pluck('event_id');
        return self::whereNotIn('id', $eventCostId)->get();
    }

    public static function getList()
    {
        $events = self::select('events.*')
            ->leftjoin('subtypes', 'subtypes.id', '=', 'events.subtype_id')
        ->leftjoin('event_on_places as eop', 'eop.event_id', '=', 'events.id')
        ->leftjoin('places', 'places.id', '=', 'eop.place_id');

        if (($filter = request()->input('filter', [])) && count((array)$filter) > 0) {
            if (isset($filter['name']) && !empty($filter['name'])) {
                $events->where('events.name', 'LIKE', '%' . $filter['name'] . '%');
            }
            if (isset($filter['duration']) && !empty($filter['duration'])) {
                $events->where('events.duration', $filter['duration']);
            }
            if (isset($filter['type']) && !empty($filter['type'])) {
                $events->where('subtypes.name', 'LIKE', '%' . $filter['type'] . '%');
            }
            if (isset($filter['place']) && !empty($filter['place'])) {
                $events->where('places.name', 'LIKE', '%' . $filter['place'] . '%');
            }
        }

        $orderName = 'events.created_at';
        $orderValue  = 'desc';
        if ($order = request()->input('order')) {
            switch ($order['name']) {
                case 'name':
                    $orderName = 'events.name';
                    break;
                case 'duration':
                    $orderName = 'events.duration';
                    break;
                case 'type':
                    $orderName = 'subtypes.name';
                    break;
                case 'place':
                    $orderName = 'places.name';
                    break;
            }
            $orderValue = $order['value'];
        }


        return $events->orderBy($orderName, $orderValue)->paginate(20);
    }
}
