<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Organization
 * @package App\Model
 */
class Organization extends Model
{
    use SoftDeletes;
    
    protected $table = 'organizations';
    
    protected $fillable = [
        'client_id',
        'type_id',
        'name',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(OrganizationType::class, 'id', 'type_id');
    }
}
