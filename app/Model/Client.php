<?php

namespace App\Model;

use App\Services\Debug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Client
 * @package App\Model
 */
class Client extends Model
{
    use SoftDeletes;

    protected $table = 'clients';

    protected $fillable = [
        'constants',
        'types'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     *
     */
    public function fizClient()
    {
        return $this->hasOne(FizClient::class, 'client_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organization()
    {
        return $this->hasOne(Organization::class, 'client_id', 'id');
    }

    /**
     * @param $type
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function model()
    {
        return (int)$this->types === 1 ? $this->organization() : $this->fizClient();
    }

    /**
     * @return mixed
     */
    public static function getClients($type = 'all')
    {
        $clients = self::select('clients.*', 'fc.name as client_name', 'o.name as organization_name', 'ot.name as type_name')
            ->leftJoin('fiz_clients as fc', 'fc.client_id', '=', 'clients.id')
            ->leftJoin('organizations as o', 'o.client_id', '=', 'clients.id')
            ->leftJoin('organization_types as ot', 'ot.id', '=', 'o.type_id')
            ->whereNull('o.deleted_at')
            ->whereNull('fc.deleted_at');

        if (($filter = request()->input('filter', [])) && count((array)$filter) > 0) {
            if (isset($filter['client_name']) && !empty($filter['client_name'])) {
                $clients->where('fc.name', 'LIKE', '%' . $filter['client_name'] . '%');
            }
            if (isset($filter['client_type']) && in_array($filter['client_type'], [true, false, 0, 1]) && $type == 0) {
                switch ($filter['client_type']) {
                    case 'active':
                        $clients->where('clients.constants', 1);
                        break;
                    case 'nonactive':
                        $clients->where('clients.constants', 0);
                        break;
                }
            }
            if (isset($filter['organization_client_type']) && in_array($filter['organization_client_type'], [true, false, 0, 1]) && $type == 1) {
                switch ($filter['organization_client_type']) {
                    case 'active':
                        $clients->where('clients.constants', 1);
                        break;
                    case 'nonactive':
                        $clients->where('clients.constants', 0);
                        break;
                }
            }
            if (isset($filter['organization_name']) && !empty($filter['organization_name'])) {
                $clients->where('o.name', 'LIKE', '%' . $filter['organization_name'] . '%');
            }
            if (isset($filter['type']) && !empty($filter['type'])) {
                $clients->where('o.type_id', $filter['type']);
            }
        }

        $orderName = 'clients.created_at';
        $orderValue  = 'desc';
        if ($order = request()->input('order')) {
            switch ($order['name']) {
                case 'client_name':
                    $orderName = 'fc.name';
                    break;
                case 'client_type':
                    $orderName = 'clients.constants';
                    break;
                case 'organization_type':
                    $orderName = 'ot.name';
                    break;
            }
            $orderValue = $order['value'];
        }

        if($type === 0 || $type === 1) {
            $clients->where('types', $type);
        }

        return $clients->orderBy($orderName, $orderValue)->paginate(20);
    }
}
