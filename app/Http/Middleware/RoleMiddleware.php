<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Log what's happening
        \Log::info('RoleMiddleware check', [
            'is_logged_in' => auth()->check(),
            'user_id' => auth()->id(),
            'user_role' => auth()->check() ? auth()->user()->role : null,
            'required_roles' => $roles,
            'url' => $request->url()
        ]);

        // Not logged in
        if (!auth()->check()) {
            \Log::warning('RoleMiddleware: User not logged in, redirecting to /');
            return redirect('/');
        }

        $userRole = auth()->user()->role;

        // Role not allowed
        if (!in_array($userRole, $roles, true)) {
            \Log::warning('RoleMiddleware: Role mismatch', [
                'user_role' => $userRole,
                'required_roles' => $roles
            ]);
            return redirect('/');
        }

        \Log::info('RoleMiddleware: Access granted');
        return $next($request);
    }
}
