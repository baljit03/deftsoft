<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class checkRole {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        // Get the required roles from the route
         if (Auth::user()) {
           
        } else {
            return redirect('admin/login');
        }
        $roles = $this->getRequiredRoleForRoute($request->route());
        $currentRole = Auth::user()->usertype;
        if (in_array($currentRole, $roles)) {
            return $next($request);
        } else {
            return redirect('admin/access-denied');
        }
    }

    private function getRequiredRoleForRoute($route) {
        $actions = $route->getAction();

        return isset($actions['roles']) ? $actions['roles'] : null;
    }

}
