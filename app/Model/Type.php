<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;

    protected $table = 'types';

    protected $fillable = [
        'name'
    ];

    /**
     * @return Type[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getTypeList()
    {
        return self::all(['id', 'name']);
    }

    public static function getList()
    {
        $types = self::select('*');

        if (($filter = request()->input('filter', [])) && count((array)$filter) > 0) {
            if (isset($filter['name']) && !empty($filter['name'])) {
                $types->where('name', 'LIKE', '%' . $filter['name'] . '%');
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

        return $types->orderBy($orderName, $orderValue)->get();
    }
}
