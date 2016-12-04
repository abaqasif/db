<?php

namespace App\Http\Controllers;
use App\pages;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $pages=new pages;
        $allpages=$pages::all();

        return view('home',compact('allpages'));
    }



     public function home_user()
    {    $user = \Auth::user();
        
         
               
            
 
            $allrights = \DB::table('users')
           -> join('user_access',  'user_access.user_id','=','users.id')
           -> join('pages','user_access.page_id','=','pages.id' )
           ->select( 'pages.id as page_id', 'pages.name as page_name',
            'pages.url', 'user_access.id'
            )
           ->where('user_access.user_id','=',$user->id)
           ->get();

            
        
/*
        $purchase = \DB::table('user_access_09372')
        ->where('user_id', '=', $user->id)
        ->where('page_id', '=', '17')
        ->exists();

        */
        

       
        return view('home_user',compact('allrights'));
    }
}
