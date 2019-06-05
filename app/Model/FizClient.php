<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FizClient
 * @package App\Model
 */
class FizClient extends Model
{
    use SoftDeletes;

    protected $table = 'fiz_clients';

    protected $fillable = [
        'client_id',
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
