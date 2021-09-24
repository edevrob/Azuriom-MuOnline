<?php

namespace Azuriom\Plugin\MuOnline\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\MuOnline\Models\MuOnlineAccount;
use Azuriom\Plugin\MuOnline\Models\MuOnlineCharacter;
use Azuriom\Plugin\MuOnline\Models\MuOnlineStats;
use Azuriom\Plugin\MuOnline\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the home admin page of the plugin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->input('search');

        $users = User::with(['ban', 'accounts'])
            ->when($search, function (Builder $query, string $search) {
                $query->scopes(['search' => $search]);
            })->paginate();
        
        return view('muonline::admin.index', [
            'users' => $users,
            'search' => $search,
        ]);
    }

    public function info()
    {
        $online = MuOnlineStats::where('ConnectStat', 1)->count();
        $accounts = MuOnlineAccount::all()->count();
        $characters = MuOnlineCharacter::pluck('AccountID')->count();

        return view('muonline::admin.info', [
            'online'     => $online,
            'accounts'   => $accounts,
            'characters' => $characters,
        ]);
    }

}
