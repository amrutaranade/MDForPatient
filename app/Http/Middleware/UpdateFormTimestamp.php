<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class UpdateFormTimestamp
{
    public function handle($request, Closure $next)
    {
        if (Session::has('form_id')) {
            Session::put('form_last_activity', now());
        }

        return $next($request);
    }
}

?>