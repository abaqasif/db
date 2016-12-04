<?php

namespace App\Http\Middleware;

use Closure;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {





         $user = \Auth::user();

        $result = \DB::table('users')
        ->where('email', '=', $user->email)
        ->where('Admin', '=', '1')
        ->exists();


           if($result)
        {  
            return $next($request);
        }
      
       
        
        
        return redirect('/home_user');

    }
}
