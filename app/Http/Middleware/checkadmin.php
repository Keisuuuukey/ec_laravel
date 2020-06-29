<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkadmin
{
    /**
     * Handle an incoming request.
     *F
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(Auth::user()->email === 'admin@admin.com'){
            return $next($request);
        }else{
            return redirect('/login');
        }
             
        // }else{
        //     return redirect('/login');
        // }

    }
}
