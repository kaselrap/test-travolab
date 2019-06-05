<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use SoftDeletes;

    protected $table = 'places';

    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_on_places', 'place_id', 'event_id');
    }

    /**
     * @return Place[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getList()
    {
        $places = self::select('*');

        if (($filter = request()->input('filter', [])) && count((array)$filter) > 0) {
            if (isset($filter['name']) && !empty($filter['name'])) {
                $places->where('name', 'LIKE', '%' . $filter['name'] . '%');
            }
        }

        $orderName = 'created_at';
        $orderValue  = 'desc';
        if ($order = request()->input('order')) {
            switch ($order['name']) {
                case 'name':
                    $orderName = 'name';
                    break;
            }
            $orderValue = $order['value'];
        }

        return $places->orderBy($orderName, $orderValue)->get();
    }

    public static function getShortList()
    {
        return self::all(['id', 'name']);
    }

    /**
     * @param string $id
     * @return string
     */
    public static function getPlaceName($id = '')
    {
        if (empty($id)) {
            return '';
        }

        $place = self::findOrFail($id);

        if ($place) {
            return $place->name;
        }

        return '';
    }
}
