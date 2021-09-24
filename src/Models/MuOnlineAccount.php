<?php

namespace Azuriom\Plugin\MuOnline\Models;

use Azuriom\Plugin\MuOnline\Models\User;
use Illuminate\Database\Eloquent\Model;

class MuOnlineAccount extends Model
{
    protected $table = null;
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'memb_guid';
    // protected $keyType = 'string';
    protected $connection = 'sqlsrv';
    
    protected $fillable = [
        'memb___id', 
        'memb__pwd', 
        'memb_name',
        'sno__numb', 
        'bloc_code', 
        'ctl1_code',
        'Azuriom_user_id',
        'Azuriom_user_access_token'
    ];

    public function __construct()
    {
        return $this->table = ''.config('database.connections.sqlsrv.database').'.dbo.MEMB_INFO';
    }


    /**
     * Return all characters for this account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function characters()
    {
        return $this->hasMany(MuOnlineCharacter::class, 'AccountID', 'memb___id');
    }

    /**
     * Return the Azuriom user.
     *
     * @return \Azuriom\Plugin\MuOnline\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'Azuriom_user_id');
    }

    public function stats()
    {
        return $this->belongsTo(MuOnlineStats::class, 'memb___id', 'memb___id');
    }
    public function CashShopData()
    {
        return $this->hasOne(MuOnlineCashShopData::class, 'AccountID', 'memb___id');
    }
}
