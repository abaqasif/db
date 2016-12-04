<?php

namespace App\Http\Middleware;

use Closure;

class page_access
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

        if($user->Admin=='1')
       { return $next($request); }

        else
       {

         $page_id = \DB::table('pages')->where('url', '=', $request->route()->getPath())->pluck('id');


      //$page_id=\DB::SELECT('select id from pages where url='." '/ ".$request->route()->getPath()." ' ");
         
         $result = \DB::table('user_access')
        ->where('user_id', '=', $user->id)
        ->where('page_id', '=', $page_id)
        ->exists();


           if($result)
        {  
            return $next($request);
        } 
      
        return redirect('/home');
}
        
    }




       }




      /* { $result = \DB::table('user_access_09372')
        ->where('user_id', '=', $user->id)
        ->where('page_id', '=', '17')
        ->exists();


           if($result)
        {  
            return $next($request);
        } 
      
        return redirect('home');
}
        
    }*/

