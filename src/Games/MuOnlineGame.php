<?php

namespace Azuriom\Plugin\MuOnline\Games;

use Azuriom\Games\Game;
use Azuriom\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class MuOnlineGame extends Game
{
    public function name()
    {
        return 'MuOnline';
    }
    public function id(){ return 'MuOnline';}

    public function getAvatarUrl(User $user, int $size = 64)
    {
        $files = Storage::files("public/muonline/avatars/{$user->id}");
        if (count($files) > 0) {
            $url = Storage::url(Arr::random($files));
        } else {
            $url = plugin_asset('muonline', 'img/unknown_avatar.png');
        }
        
        return $url;
    }

    public function getUserUniqueId(string $name)
    {
        return null;
    }

    public function getUserName(User $user)
    {
        return $user->name;
    }

    public function getSupportedServers()
    {
        return [
            'muonline-server' => MuOnlineServerBridge::class,
        ];
    }
}
