<?php

namespace Azuriom\Plugin\MuOnline\Controllers;

use Azuriom\Models\User;
use Azuriom\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Azuriom\Http\Controllers\Controller;
use Illuminate\Database\Schema\Blueprint;

class InstallController extends Controller
{
    public function index()
    {
        return view('muonline::install.index');
    }

    public function adminAccount()
    {
        return view('muonline::install.admin');
    }

    public function storeAdminAccount(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:50'], // TODO ensure unique
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'game_id' => null,
        ]);

        $user->markEmailAsVerified();
        $user->forceFill(['role_id' => 2])->save();
        Setting::updateSettings([
            'muonline_installed' => 1
        ]);

        return redirect()->route('home');
    }

    public function setupDatabase(Request $request)
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
            if ($th->getMessage() === 'could not find driver') {
                $architecture = ((PHP_INT_SIZE === 4) ? 'x86' : 'x64');
                $ThreadSafe = ZEND_THREAD_SAFE ? 'TS version' : 'NTS version';
                $phpVersion = (float)phpversion();
                $inipath = php_ini_loaded_file();
                $tmp = Str::beforeLast($inipath, 'php.ini');
                $extfolder = Str::substr($tmp, 0, \strlen($tmp)-1).'/ext';
                $error = <<<EOT
                    <code>sqlsrv</code> and <code>pdo_sqlsrv</code> drivers are wrong version or not installed.<br>
                    Please verify that you choosed the <code>{$architecture} {$ThreadSafe}, for php {$phpVersion}</code><br>
                    Make sure you installed them at the extension folder : <br>
                    - <code>{$extfolder}</code><br>
                    Then verify you enabled the drivers at your php.ini: <br>
                    - <code>{$inipath}</code><br>
                    Then restart you webserver
                EOT;

                return redirect()->route('muonline.install.index')->with('error', $error);
            }
            return redirect()->route('muonline.install.index')->with('error', $th->getMessage());
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

        return redirect()->route('muonline.install.adminAccount')->with('success', 'SQL Server configured!');
    }
}