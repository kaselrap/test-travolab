<?php

namespace App\Model;

use App\Services\Debug;
use App\Traits\Data;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Employee
 * @package App\Model
 */
class Employee extends Model
{
    use SoftDeletes,
        Data;

    protected $table = 'employees';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function setName($value)
    {
        $this->name = implode(' ', (array)$value);

        return $this;
    }

    public function getFirstNameAttribute()
    {
        return $this->getSplitName(0);
    }

    public function getLastNameAttribute()
    {
        return $this->getSplitName(1);
    }

    public function getMiddleNameAttribute()
    {
        return $this->getSplitName(2);
    }

    public function getSplitName($part = 0)
    {
        return explode(' ', $this->name)[$part] ?? '';
    }

    public function schedules()
    {
        return $this->hasMany(WorkStatus::class, 'employee_id', 'id');
    }

    public function schedule()
    {
        return $this->hasOne(WorkStatus::class, 'employee_id', 'id');
    }

    public static function getAllList()
    {
        $employees = self::select('*');

        if (($filter = request()->input('filter', [])) && count((array)$filter) > 0) {
            if (isset($filter['name']) && !empty($filter['name'])) {
                $employees->where('name', 'LIKE', '%' . $filter['name'] . '%');
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


        return $employees->orderBy($orderName, $orderValue)->paginate(20);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
