<?php

namespace Azuriom\Plugin\MuOnline\Models;

use Azuriom\Plugin\MuOnline\Models\User;
use Illuminate\Database\Eloquent\Model;

class MuOnlineGuild extends Model
{
    protected $table = null;
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'G_Name';
    // protected $keyType = 'string';
    protected $connection = 'sqlsrv';
    
    protected $fillable = [];

    public function __construct()
    {
        return $this->table = ''.config('database.connections.sqlsrv.database').'.dbo.Guild';
    }


}
