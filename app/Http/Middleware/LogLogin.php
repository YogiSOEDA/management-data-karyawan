<?php

namespace App\Http\Middleware;

use App\Models\LoginLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        // Auth::login($user);
        if (Auth::check()) {
            $user = Auth::user();

            if (!$request->session()->has('login_logged')) {
                LoginLog::create([
                    'user_id' => Auth::id(),
                    'login_time' => now(),
                    'status' => 'success',
                ]);

                $request->session()->put('login_logged', true);
            }
        } elseif ($request->isMethod('post') && $request->routeIs('login')) {
            LoginLog::create([
                'user_id' => null,
                'login_time' => now(),
                'status' => 'failed',
            ]);
        }

        return $response;
    }

    public function terminate($request, $response)
    {
        if (Auth::check()) {
            $log = LoginLog::where('user_id', Auth::id())->latest()->first();
            if ($log && !$log->logout_time) {
                $log->update(['logout_time' => now()]);
            }
        }
    }
}
