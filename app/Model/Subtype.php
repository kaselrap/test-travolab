<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subtype extends Model
{
    use SoftDeletes;

    protected $table = 'subtypes';

    protected $fillable = [
        'name',
        'type_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    /**
     * @return Subtype[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getList()
    {
        $subtypes = self::select('*');

        if (($filter = request()->input('filter', [])) && count((array)$filter) > 0) {
            if (isset($filter['subname']) && !empty($filter['subname'])) {
                $subtypes->where('name', 'LIKE', '%' . $filter['subname'] . '%');
            }
            if (isset($filter['type']) && !empty($filter['type'])) {
                $subtypes->where('type_id', $filter['type']);
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

        return $subtypes->orderBy($orderName, $orderValue)->get();
    }
}
