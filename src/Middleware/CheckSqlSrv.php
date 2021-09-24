<?php

namespace Azuriom\Plugin\MuOnline\Middleware;

use Closure;

class CheckSqlSrv
{
    public function handle($request, Closure $next)
    {
        if (!setting()->has('muonline.sqlsrv_host') && plugins()->isEnabled('muonline')) {
            if ($request->is('admin/muonline/settings') || $request->is('admin/plugins*')) {
                return $next($request);
            }

            if ($request->is('admin') || $request->is('admin/muonline*')) {
                return redirect()->route('muonline.admin.settings')->with('error', 'MuOnline SQL Server configuration is needed.');
            }
        }

        return $next($request);
    }
}
