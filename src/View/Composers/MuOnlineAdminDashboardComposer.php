<?php

namespace Azuriom\Plugin\MuOnline\View\Composers;

use Azuriom\Extensions\Plugin\AdminDashboardCardComposer;
use Azuriom\Plugin\MuOnline\Models\MuOnlineAccount;
use Azuriom\Plugin\MuOnline\Models\MuOnlineCharacter;
use Azuriom\Plugin\MuOnline\Models\MuOnlineStats;

class MuOnlineAdminDashboardComposer extends AdminDashboardCardComposer
{
    public function getCards()
    {
        try {
            $user_count = MuOnlineAccount::count();
            $character_count = MuOnlineCharacter::count();
            $online = MuOnlineStats::where('ConnectStat', 1)->count();
        } catch (\Throwable $th) {
            $user_count = 0;
            $online = 0;
            $character_count = 0;
        }

        return [
            'muonline_accounts' => [
                'color' => 'warning',
                'name' => 'game accounts',
                'value' => $user_count,
                'icon' => 'fas fa-user',
            ],
            'muonline_characters' => [
                'color' => 'warning',
                'name' => 'in-game characters',
                'value' => $character_count,
                'icon' => 'fas fa-star',
            ],
            'online_users' => [
                'color' => 'info',
                'name' => 'online users',
                'value' => $online,
                'icon' => 'fas fa-gamepad',
            ],
        ];
    }
}
