<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\pages;

class MenuComposer 
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */




    public function __construct(){

           $user= \Auth::user();
           $user_id=$user->id;

           if($user->Admin==0){
           $this->allrights= \DB::table('users')
           -> join('user_access',  'user_access.user_id','=','users.id')
           -> join('pages','user_access.page_id','=','pages.id' )
           ->select( 'pages.id as page_id', 'pages.name as page_name',
            'pages.url', 'user_access.id'
            )
           ->where('user_access.user_id','=',$user_id)
           ->get();


        /*  $this->purchase_module= \DB::table('users')
           -> join('user_access_09372',  'user_access_09372.user_id','=','users.id')
           -> join('pages','user_access_09372.page_id','=','pages.id' )
           ->select( 'pages.id as page_id', 'pages.name as page_name',
            'pages.url', 'user_access_09372.id'
            )
           ->where('user_access_09372.user_id','=',$user_id) 
           ->where('pages.name','LIKE','%'.'RAW MATERIALS')
           ->orWhere('pages.name','LIKE','%'.'SUPPLIERS')
           ->orWhere('pages.name','LIKE','%'.'PURCHASES') 
           ->get();



         $this->all_users= \DB::table('users')
           -> join('user_access_09372',  'user_access_09372.user_id','=','users.id')
           -> join('pages','user_access_09372.page_id','=','pages.id' )
           ->select( 'pages.id as page_id', 'pages.name as page_name',
            'pages.url', 'user_access_09372.id'
            )
           ->where('user_access_09372.user_id','=',$user_id) 
           ->where('pages.name','LIKE','%'.'USER')
           ->get();


      $this->all_pages= \DB::table('users')
           -> join('user_access_09372',  'user_access_09372.user_id','=','users.id')
           -> join('pages','user_access_09372.page_id','=','pages.id' )
           ->select( 'pages.id as page_id', 'pages.name as page_name',
            'pages.url', 'user_access_09372.id'
            )
           ->where('user_access_09372.user_id','=',$user_id) 
           ->where('pages.name','LIKE','%'.'PAGE')
           ->get();


           $this->all_rights= \DB::table('users')
           -> join('user_access_09372',  'user_access_09372.user_id','=','users.id')
           -> join('pages','user_access_09372.page_id','=','pages.id' )
           ->select( 'pages.id as page_id', 'pages.name as page_name',
            'pages.url', 'user_access_09372.id'
            )
           ->where('user_access_09372.user_id','=',$user_id) 
           ->where('pages.name','LIKE','%'.'RIGHT')
           ->get(); */




       }

       else{
         
          $this->allrights=pages::all();
  

   /*$this->purchase_module= \DB::table('users')
           -> join('user_access_09372',  'user_access_09372.user_id','=','users.id')
           -> join('pages','user_access_09372.page_id','=','pages.id' )
           ->select( 'pages.id as page_id', 'pages.name as page_name',
            'pages.url', 'user_access_09372.id'
            )
           ->where('pages.name','LIKE','%'.'RAW MATERIALS')
           ->orWhere('pages.name','LIKE','%'.'SUPPLIERS')
           ->orWhere('pages.name','LIKE','%'.'PURCHASES') 
           ->get();



         $this->all_users= \DB::table('users')
           -> join('user_access_09372',  'user_access_09372.user_id','=','users.id')
           -> join('pages','user_access_09372.page_id','=','pages.id' )
           ->select( 'pages.id as page_id', 'pages.name as page_name',
            'pages.url', 'user_access_09372.id'
            )
           ->where('pages.name','LIKE','%'.'USER')
           ->get();


      $this->all_pages= \DB::table('users')
           -> join('user_access_09372',  'user_access_09372.user_id','=','users.id')
           -> join('pages','user_access_09372.page_id','=','pages.id' )
           ->select( 'pages.id as page_id', 'pages.name as page_name',
            'pages.url', 'user_access_09372.id'
            ) 
           ->where('pages.name','LIKE','%'.'PAGE')
           ->get();


           $this->all_rights= \DB::table('users')
           -> join('user_access_09372',  'user_access_09372.user_id','=','users.id')
           -> join('pages','user_access_09372.page_id','=','pages.id' )
           ->select( 'pages.id as page_id', 'pages.name as page_name',
            'pages.url', 'user_access_09372.id'
            )
           ->where('pages.name','LIKE','%'.'RIGHT')
           ->get();
*/





          }


    }
    public function compose(View $view)
    {     

       $view->with('allrights',$this->allrights);
    }

    
}