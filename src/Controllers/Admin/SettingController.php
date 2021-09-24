<?php

namespace Azuriom\Plugin\MuOnline\Controllers\Admin;

use Azuriom\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Azuriom\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    /**
     * Show the home admin page of the plugin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->input('search');

        return view('muonline::admin.settings');
    }

    public function update(Request $request)
    {
        DB::purge();

        config([
            'database.connections.sqlsrv.host' => $request->input('sqlsrv_host'),
            'database.connections.sqlsrv.port' => $request->input('sqlsrv_port'),
            'database.connections.sqlsrv.username' => $request->input('sqlsrv_username'),
            'database.connections.sqlsrv.password' => $request->input('sqlsrv_password'),
            'database.connections.sqlsrv.database' => $request->input('sqlsrv_dbname'),
        ]);

        try {
            DB::connection('sqlsrv')->getPdo();
        } catch (\Throwable $th) {
            return redirect()->route('muonline.admin.settings')->with('error', $th->getMessage());
        }

        Setting::updateSettings([
            'muonline.sqlsrv_host' => $request->input('sqlsrv_host'),
            'muonline.sqlsrv_port' => $request->input('sqlsrv_port') ?? '',
            'muonline.sqlsrv_username' => $request->input('sqlsrv_username'),
            'muonline.sqlsrv_password' => $request->input('sqlsrv_password'),
            'muonline.sqlsrv_dbname' => $request->input('sqlsrv_dbname'),
            'muonline.game_maxonline' => $request->input('game_maxonline'),
            'muonline.game_resetzen' => $request->input('game_resetzen'),
            'muonline.sqlsrv_dbtype' => $request->input('server_files'),
        ]);

        if (! Schema::connection('sqlsrv')->hasColumn('MEMB_INFO', 'Azuriom_user_id')) {
            Schema::connection('sqlsrv')->table('MEMB_INFO', function (Blueprint $table) {
                $table->integer('Azuriom_user_id')->nullable();
                $table->string('Azuriom_user_access_token')->nullable();
            });
        }

        return redirect()->route('muonline.admin.settings')->with('success', 'SQL Server configured!');
    }
}
