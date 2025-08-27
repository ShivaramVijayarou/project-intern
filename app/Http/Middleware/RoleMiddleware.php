<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//     // public function handle(Request $request, Closure $next, $role): Response
//     // {

//     //     if (!Auth::check() || Auth::user()->role !== $role) {
//     //         abort(403, 'Unauthorized');
//     //     }
//     //     return $next($request);

//     // }




//     public function handle(Request $request, Closure $next, $role)
//     {
//         if (!Auth::check() || Auth::user()->role !== $role) {
//             abort(403, 'Unauthorized');
//         }

//         return $next($request);
//     }
// }


{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): \Symfony\Component\HttpFoundation\Response  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Ensure the user is logged in
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        // Check if the user's role is in the allowed list
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
