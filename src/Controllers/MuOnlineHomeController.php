<?php

namespace Azuriom\Plugin\MuOnline\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\MuOnline\Models\User;

class MuOnlineHomeController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::ofUser(auth()->user());
        return view('muonline::index', ['user'=>$user]);
    }
}
