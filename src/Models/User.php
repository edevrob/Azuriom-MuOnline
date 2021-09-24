<?php

namespace Azuriom\Plugin\MuOnline\Models;

use Illuminate\Support\Collection;
use Azuriom\Models\User as BaseUser;
use Azuriom\Plugin\MuOnline\Models\MuOnlineAccount;
// use Azuriom\Plugin\Flyff\Models\FlyffCharacter;

class User extends BaseUser
{

    public function accounts()
    {
        return $this->hasMany(MuOnlineAccount::class, 'Azuriom_user_id');
    }

    /**
     * @param  \Azuriom\Models\User  $baseUser
     * @return static
     */
    public static function ofUser(BaseUser $baseUser)
    {
        return (new self())->newFromBuilder($baseUser->getAttributes());
    }

    public function characters()
    {
        return $this->hasManyThrough(MuOnlineCharacter::class, MuOnlineAccount::class, 'Azuriom_user_id', 'AccountID', 'id', 'memb_guid');
    }
}
