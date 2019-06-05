<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrganizationType
 * @package App\Model
 */
class OrganizationType extends Model
{
    use SoftDeletes;

    protected $table = 'organization_types';

    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organisations()
    {
        return $this->hasMany(Organization::class, 'type_id', 'id');
    }

    public static function getFirst()
    {
        return self::first() ?: new self();
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
