<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function show_own_right(){

               $user = \Auth::user();
            
 
            $allrights = \DB::table('users')
           -> join('user_access_09372',  'user_access_09372.user_id','=','users.id')
           -> join('pages','user_access_09372.page_id','=','pages.id' )
           ->select( 'pages.id as page_id', 'pages.name as page_name',
            'pages.url', 'user_access_09372.id'
            )
           ->where('user_access_09372.user_id','=',$user->id)
           ->get();

             return view('user_pages.show_own_right',compact('allrights'));
}






}
