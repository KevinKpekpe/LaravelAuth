<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        $user = Auth::user();
        $url = $request->path();
        if (preg_match('/^admin/', $url)) {
            if ($user->role == 'admin') {
                return $next($request);
            } else {
                return response()->view('unaututhorized');
            }
        } else {
            if ($user->role == 'client') {
                return $next($request);
            }else{
                return response()->view('unaututhorized');
            }

        }


        // if (!$user) {
        //     return redirect()->route('login');
        // }

        // foreach ($roles as $role) {
        //     if ($user->role === $role) {
        //         return $next($request);
        //     }
        // }

        // return redirect()->back()->withErrors(['error' => 'This page is reserved for '.$roles.' only']);
    }
}
