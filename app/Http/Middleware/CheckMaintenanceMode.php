<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class CheckMaintenanceMode {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $data = DB::table('tbl_system_setting')->where("key", "maintaince_mode")->get();
        if ($data[0]->value == 1) {
            return redirect('maintenance-mode');
        }
        
        return $next($request);
    }

}
