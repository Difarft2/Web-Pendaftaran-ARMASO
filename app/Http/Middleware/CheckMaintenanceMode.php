<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Mode;

class CheckMaintenanceMode
{
        /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (Mode::getValue('maintenance_mode') === 'on') {
            // return response()->json(['message' => 'Maaf sedang dalam maintenance.'], 403);
            return response()->view('errors.maintenance');
        }

        return $next($request);
    }
}