<?php

namespace Azuriom\Plugin\MuOnline\Providers;

use Azuriom\Extensions\Plugin\BasePluginServiceProvider;
use Azuriom\Models\Setting;
use Azuriom\Plugin\MuOnline\Games\MuOnlineGame;
use Azuriom\Plugin\MuOnline\Models\MuOnlineAccount;
use Azuriom\Plugin\MuOnline\View\Composers\MuOnlineAdminDashboardComposer;
use Azuriom\Providers\GameServiceProvider;
use Azuriom\Support\SettingsRepository;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class MuOnlineServiceProvider extends BasePluginServiceProvider
{
    /**
     * The plugin's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        // \Azuriom\Plugin\MuOnline\Middleware\ExampleMiddleware::class,
    ];

    /**
     * The plugin's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [];

    /**
     * The plugin's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // 'example' => \Azuriom\Plugin\MuOnline\Middleware\ExampleRouteMiddleware::class,
    ];

    /**
     * The policy mappings for this plugin.
     *
     * @var array
     */
    protected $policies = [
        // User::class => UserPolicy::class,
    ];

    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->registerMiddlewares();
        // $this->app['router']->pushMiddlewareToGroup('web', EnsureGameIsInstalled::class);

        GameServiceProvider::registerGames(['muonline'=> MuOnlineGame::class]);
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        $this->setupSqlServer();

        $this->loadViews();

        $this->loadTranslations();

        $this->loadMigrations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        $this->registerUserNavigation();

        //
        View::composer('admin.dashboard', MuOnlineAdminDashboardComposer::class);

    }

    /**
     * Returns the routes that should be able to be added to the navbar.
     *
     * @return array
     */
    protected function routeDescriptions()
    {
        return [
            //
        ];
    }
    

    /**
     * Return the admin navigations routes to register in the dashboard.
     *
     * @return array
     */
    protected function adminNavigation()
    {
        return [
            
            'muonline' => [
                'name' => 'MuOnline',
                'type' => 'dropdown',
                'icon' => 'fas fa-star',
                'route' => 'muonline.admin.*',
                'items' => [
                    'muonline.admin.settings'   => 'Settings',
                    'muonline.admin.info'       => 'Info',
                    'muonline.admin.users'      => 'Users',
                    'muonline.admin.characters' => 'Characters',
                ],
            ],
        ];
    }

    /**
     * Return the user navigations routes to register in the user menu.
     *
     * @return array
     */
    protected function userNavigation()
    {
        return [
            'accounts' => [
                'route' => 'muonline.accounts.index',
                'name' => 'muonline::messages.game-accounts',
            ],
            'characters' => [
                'route' => 'muonline.accounts.characters',
                'name' => 'muonline::messages.my-characters',
            ],
        ];
    }

    private function setupSqlServer()
    {;
        
        $settings = app(SettingsRepository::class);
        if(config('database.default') !== 'sqlsrv') {
            //The SqlServer connection has to be setup for every requests if the default is not sqlsrv
            if($settings->has('muonline.sqlsrv_host')) {
                config([
                    'database.connections.sqlsrv.host' => $settings->get('muonline.sqlsrv_host', ''),
                    'database.connections.sqlsrv.port' => $settings->get('muonline.sqlsrv_port', ''),
                    'database.connections.sqlsrv.username' => $settings->get('muonline.sqlsrv_username', ''),
                    'database.connections.sqlsrv.password' => $settings->get('muonline.sqlsrv_password', ''),
                    'database.connections.sqlsrv.database' => $settings->get('muonline.sqlsrv_dbname', ''),
                ]);

                DB::purge();
            } else {
                //The middleware should redirect to settings to setup the connection

                $this->app['router']->pushMiddlewareToGroup('web', \Azuriom\Plugin\MuOnline\Middleware\CheckSqlSrv::class);
            }
        }
    }
}
