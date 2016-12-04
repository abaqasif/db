<?php


namespace App\Http\Controllers;
use App\pages;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\user_access;
use App\User;

class adminController extends Controller

{


    public function __construct()
    {
       
      $this->middleware('isAdmin');
        
        
    }



public function get_all_pages(){

    $pages=new pages;
    $allpages=$pages::all();
    return $allpages;
} 



public function edit_user_form(){
   
	return view('admin_pages.edit_user');
}





public function delete_user_form(){
    

	return view('admin_pages.delete_user');
}

 public function edit_user(Request $Request){
    
 $current_time = \Carbon\Carbon::now()->toDateTimeString();   
 \DB::table('users')
->where('email', $Request->o_email)
->update(
    ['password'=>
    bcrypt($Request->password) , 'Admin'=>$Request->admin, 'email'=>$Request->email, 'name'=>$Request->name, 'updated_at'=>$current_time]);




     return redirect('/home');

}

public function register_user_form(){
  
    return view('admin_pages.register_user');
}

public function register_user(Request $Request){


 $current_time = \Carbon\Carbon::now()->toDateTimeString();   
 \DB::table('users')

->Insert(
    ['email'=>$Request->email,'password'=>
    bcrypt($Request->password) , 'Admin'=>$Request->admin, 'updated_at'=>$current_time]);




     return redirect('/home');


}


 public function delete_user(Request $Request){
    
 
\DB::table('users')->where('email',$Request->email)->delete();

    return redirect('/home');
}



public function show_user(){
      

$allusers=\DB::table('users')
            ->get();
 
    return view('admin_pages.show_user',compact('allusers'));



}


public function search_user(){
      $allpages=self::get_all_pages();
    return view('admin_pages.search_user',compact('allpages'));}

public function search(Request $Request){
    if($Request->ajax()){

        $output="";
        $admin="";
        $users=\DB::table('users')
            ->where('name','LIKE','%'.$Request->search.'%')
            ->orWhere('email','LIKE','%'.$Request->search.'%')
            ->orWhere('id','LIKE','%'.$Request->search.'%')->get();


     
        


                                 if($users){
                                 foreach($users as $key=>$user){
                                    if($user->Admin=='1'){
                                        $admin='YES';
                                    }
                                    else{$admin='NO';}
                                    $output.='<tr>'.
                                    '<td>'.$user->id.'<td>'.
                                    '<td>'.$user->name.'<td>'.
                                    '<td>'.$user->email.'<td>'.
                                    '<td>'.$admin.'<td>'.'<tr>';
                                   

}return Response($output);
                                
                                

                             }  else{ 


   return Response()->json(['no'=>'Not Found']);
                             }
                                 

  

}
}



public function create_page_form(){
       $allpages=self::get_all_pages();
	return view('admin_pages.create_page',compact('allpages'));


}


public function create_page(Request $Request){
   

    $this->validate($Request,[
    'name'=>'required|unique:pages',
    'url'=>'required|unique:pages',
   


    ]);
    
    
\DB::table('pages')->insert(
    ['name' => strtoupper($Request->name), 'url'=>
    	$Request->url] );

     return redirect('/create_page_form');

}



public function edit_page_form(){
      $allpages=self::get_all_pages();
 return view('admin_pages.edit_page',compact('allpages'));

}


public function edit_page(Request $Request){

      $this->validate($Request,[
     'id'=>'required',
   
   


    ]);
    
 
\DB::table('pages')
->where('id', $Request->id)
->update(
    ['url'=>
        $Request->url, 'name'=>strtoupper($Request->name)]);




     return redirect('/home');







}


public function delete_page_form(){
      $allpages=self::get_all_pages();
 return view('admin_pages.delete_page',compact('allpages'));

}



public function delete_page(Request $Request){

      $this->validate($Request,[
      'id'=>'required',
   


    ]);
    
 
\DB::table('pages')
->where('id', $Request->id)->delete();



     return redirect('/home');



}


public function show_page(){
     $allpages=self::get_all_pages();
     
 
    return view('admin_pages.show_page',compact('allpages'));



}


public function search_page(){
      $allpages=self::get_all_pages();
    return view('admin_pages.search_page',compact('allpages'));}

public function p_search(Request $Request){
    if($Request->ajax()){

        $output="";
        $admin="";
        $pages=new pages;

           $pgs= pages::where('name','LIKE','%'.$Request->search.'%')
            ->orWhere('id','LIKE','%'.$Request->search.'%')
            ->orWhere('url','LIKE','%'.$Request->search.'%')->get();


     
        


                                 if($pgs){
                                 foreach($pgs as $key=>$pg){
                                    
                                  
                                    $output.='<tr>'.
                                    '<td>'.$pg->id.'<td>'.
                                    '<td>'.$pg->name.'<td>'.
                                    '<td>'.$pg->url.'<td>'.'<tr>';
                                   

}return Response($output);
                                
                                

                             }  else{ 


   return Response()->json(['no'=>'Not Found']);
                             }
                                 

  

}
}

public function create_right_form(){
      $allpages=self::get_all_pages();
    

    return view('admin_pages.create_right',compact('allpages'));
}




public function create_right(Request $Request){



$section=$Request->mypage;
$pages=new pages;
$pg=$pages::where('name', 'LIKE', '%'.$section.'%')
      ->get();




foreach($pg as $page)

{$access_rights=new user_access;

$access_rights->user_id=$Request->id;
$access_rights->page_id=$page->id;
$access_rights->save();

}




return redirect('/create_right_form');


/*
    $page_id=\DB::table('pages')
   
    ->where('name',$Request->mypage)
    -> value('id');
        
    \DB::table('user_access')->insert(
    ['user_id'=>
        $Request->id, 'page_id' =>$page_id] );
    
      return redirect('/home');*/


}

public function edit_right_form(){
     $allpages=\DB::table('pages')->get();

       return view('admin_pages.edit_right',compact('allpages'));
}

public function edit_right(Request $Request){

$oldsection=$Request->oldpage;
/*$oldpages=new pages;*/
$opg=pages::where('name', 'LIKE', '%'.$oldsection.'%')->get();

foreach ($opg as $key => $oid) {
  $del=user_access::where('page_id',"=",$oid->id)->delete();
}



$newsection=$Request->newpage;
$pages=new pages;
$pg=$pages::where('name', 'LIKE', '%'.$newsection.'%')
->get();







foreach($pg as $page)

{
 $access_rights=new user_access;

$access_rights->user_id=$Request->id;
$access_rights->page_id=$page->id;
/*$access_rights->created_at=$opg->created_at;
$access_rights->updated_at=$current_time;*/
$access_rights->save();

}
 



/*
$page_id=\DB::table('pages')
     
    ->where('name',$Request->page)
    ->value('id');
    


   
    
        
    \DB::table('user_access')
      ->where('id', $Request->r_id)
    ->update(
    ['user_id'=>
        $Request->id, 'page_id' =>$page_id ,'updated_at' =>$current_time] );*/
  
 return redirect('/home');
}









public function delete_right_form(){
         $allpages=self::get_all_pages();
       return view('admin_pages.delete_right',compact('allpages'));
}






public function delete_right(Request $Request){
 
$user=$Request->id;
$section=$Request->mypage;

$pages=new pages;
$page=pages::where('name', 'LIKE', '%'.$section.'%')->get();

foreach ($page as $key => $pg) {
user_access::where('page_id',$pg->id) 
->where('user_id',$user)
->delete();
}






   /* \DB::table('user_access')
    ->where('id', $Request->id)
    ->delete();
*/

    return redirect('/home');
}

public function show_right(){


            $allpages=self::get_all_pages();
 
          
            $allrights = \DB::table('users')
            -> join('user_access',  'user_access.user_id','=','users.id')
            -> join('pages',  'user_access.page_id','=','pages.id')
            
            ->select('users.id as user_id', 'users.name as user_name','user_access.id as id','pages.id as page_id','pages.name as page_name','pages.url as url')

           ->get();


           /*$user=User::all();
           $pages=pages::all();
           $access_rights=user_access::all();
           $allrights= 'access_rights'::join('pages','user_access.page_id','=', 'pages.id')->get();*/

        /*$allrights=  user::join('page_access','page_access.user_id',"=", 'user.id');*/
           /*   return compact('allrights');*/
             return view('admin_pages.show_right',compact('allrights','allpages'));
}


public function search_right(){
      $allpages=self::get_all_pages();
    return view('admin_pages.search_right',compact('allpages'));}

public function r_search(Request $Request){
    if($Request->ajax()){

        $output="";
        $admin="";
        

             $access_rights = \DB::table('users')
            -> join('user_access',  'user_access.user_id','=','users.id')
            -> join('pages',  'user_access.page_id','=','pages.id')
            
            ->select('users.id as user_id', 'users.name as user_name','user_access.id as id','pages.id as page_id','pages.name as page_name','pages.url as url')
            ->where('users.id','LIKE','%'.$Request->search.'%')
            ->orWhere('users.name','LIKE','%'.$Request->search.'%')
            ->orWhere('pages.id','LIKE','%'.$Request->search.'%')
            ->orWhere('pages.url','LIKE','%'.$Request->search.'%')
            ->orWhere('user_access.id','LIKE','%'.$Request->search.'%')
            ->get();


     
        


                                 if($access_rights){
                                 foreach($access_rights as $key=>$access_right){
                                    
                                  
                                    $output.='<tr>'.
                                    '<td>'.$access_right->user_id.'<td>'.
                                    '<td>'.$access_right->page_id.'<td>'.
                                    '<td>'.$access_right->user_name.'<td>'.
                                    '<td>'.$access_right->page_name.'<td>'.
                                    '<td>'.$access_right->url.'<td>'.'<tr>';



}return Response($output);
                                
                                

                             }  else{ 


   return Response()->json(['no'=>'Not Found']);
                             }
                                 

  

}
}



public function page_details(Request $Request){

$id=$Request->page_id;
$page=pages::where('id','=',$id)->first();
$output=array([
'p_name'=>$page->name,
'p_url'=>$page->url


]);

return response($output);

}

}
