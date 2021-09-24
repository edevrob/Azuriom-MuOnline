<?php

namespace Azuriom\Plugin\MuOnline\Games;

use RuntimeException;
use Azuriom\Models\User;
use Azuriom\Games\ServerBridge;
use Azuriom\Plugin\MuOnline\Models\MuOnlineAccount;
use Azuriom\Plugin\MuOnline\Models\MuOnlineCharacter;
use Azuriom\Plugin\MuOnline\Models\MuOnlineGuild;
use Azuriom\Plugin\MuOnline\Models\MuOnlineStats;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * 
 * 
 * 
 */

class MuOnlineServerBridge extends ServerBridge
{
    protected const DEFAULT_PORT = 55901;

    public function getServerData()
    {

        if (@fsockopen($this->server->address, $this->server->port, $errorno, $errorstr, 0.3)) {
            
            $connected = MuOnlineStats::where('ConnectStat', 1)->count();
            $maxPlayerConnected = setting('muonline.game_maxonline');
            $topplayers = MuOnlineCharacter::select(['Name', 'cLevel', 'Class', 'RESETS'])
            ->orderByDesc('RESETS')->take(5)->get();

            $user_count = MuOnlineAccount::count();
            $character_count = MuOnlineCharacter::count();

            $guilds = MuOnlineGuild::orderbyDesc('G_Score')->take(5)->get();
            $total_guilds = MuOnlineGuild::count();
    
            return [
                'players'           => $connected,
                'max_players'       => $maxPlayerConnected,
                'topplayers'        => $topplayers,
                'total_characters'  => $character_count,
                'total_accounts'    => $user_count,
                'guilds'            => $guilds,
                'total_guilds'      => $total_guilds,
            ];
        }
        return null;
    }

    public function verifyLink()
    {
        return !! @fsockopen($this->server->address, $this->server->port, $errorno, $errorstr, 0.3);
    }


    public function canExecuteCommand()
    {
        return true;
    }

    public function getDefaultPort()
    {
        return self::DEFAULT_PORT;
    }

    
}
