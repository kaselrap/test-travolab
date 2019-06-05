<?php

namespace App\Model;

use App\Services\Debug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reservation
 * @package App\Model
 */
class Reservation extends Model
{
    use SoftDeletes;

    protected $table = 'reservations';

    protected $fillable = [
        'client_id',
        'employee_id',
        'call_day',
        'phone',
        'children_num',
        'receiving',
        'document',
        'summ',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clients()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fizClients()
    {
        return $this->hasOne(FizClient::class, 'id', 'fiz_client_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function treaty()
    {
        return $this->hasOne(Treatie::class, 'reservation_id', 'id');
    }

    public function getSumm()
    {
        $treaty = $this->treaty;
        if ($treaty) {
            $eventOnPlace = $treaty->event;
            if ($eventOnPlace){
                $event = $eventOnPlace->event;
                if ($event) {
                    $eventCoast = $event->eventCoast;
                    if ($eventCoast){
                        $summ = 0;
                        $children_num = $this->children_num ?: 1;
                        $receiving = $this->receiving ?: 1;
                        $summ += $children_num >= 6 ? (($eventCoast->coast_more_five_spec ?: 1) * $children_num) : (($eventCoast->coast_less_five_spec ?: 1) * $children_num);
                        $summ += $receiving >= 6 ? (($eventCoast->coast_more_five_other ?: 1) * $receiving) : (($eventCoast->coast_less_five_other ?: 1) * $receiving);

                        return $summ;
                    }
                }
            }
        }

        return 0;
    }
}
