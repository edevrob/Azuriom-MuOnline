<?php

namespace Azuriom\Plugin\MuOnline\Models;

use Illuminate\Database\Eloquent\Model;

class MuOnlineCashShopData extends Model
{
    protected $table = null;
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'AccountID';
    // protected $keyType = 'string';
    protected $connection = 'sqlsrv';

    public function __construct()
    {
        return $this->table = ''.config('database.connections.sqlsrv.database').'.dbo.CashShopData';
    }
    

    /**
     * Return all Cash Shop Data for this account.
     */
    public function user()
    {
        return $this->belongsTo(MuOnlineAccount::class, 'memb___id', 'AccountID');
    }

}
