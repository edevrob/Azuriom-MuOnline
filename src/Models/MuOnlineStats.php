<?php

namespace Azuriom\Plugin\MuOnline\Models;

use Illuminate\Database\Eloquent\Model;

class MuOnlineStats extends Model
{
    protected $table = null;
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'memb___id';
    // protected $keyType = 'string';
    protected $connection = 'sqlsrv';

    public function __construct()
    {
        return $this->table = ''.config('database.connections.sqlsrv.database').'.dbo.MEMB_STAT';
    }
    

    /**
     * Return all characters for this account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function characters()
    {
        return $this->hasMany(MuOnlineAccount::class, 'memb___id', 'memb___id');
    }

}
