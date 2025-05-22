<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UpdateLastLoginAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Mettre à jour last_login_at seulement si la dernière mise à jour date de plus de 5 minutes
            if (!$user->last_login_at || $user->last_login_at->diffInMinutes(Carbon::now()) > 5) {
                $user->updateLastLoginAt();
            }
        }
        
        return $next($request);
    }
}