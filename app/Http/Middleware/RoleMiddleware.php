<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            // non authentifié => redirection vers login
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Superadmin a toujours accès
        if ($user->role === 'adminuser') {
            return $next($request);
        }

        // Vérifier si le rôle de l'utilisateur est dans la liste des rôles autorisés
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Pas le bon rôle => accès interdit
        abort(403, 'Accès refusé');
    }
}
