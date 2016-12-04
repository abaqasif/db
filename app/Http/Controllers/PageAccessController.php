<?php

namespace App\Http\Controllers;


use App\Page;
use App\User;
//use App\Page;
use Illuminate\Http\Request;

use App\Http\Requests;

class PageAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }



    public function index()
    {
        $users = User::all();
//        foreach ($users as $user){
//        foreach($user->pages as $page){
//         echo $page->name;
//        }
    //}
     return view('access.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $pages = Page::all();
//        foreach ($users as $user) {
//            $user->pages()->attach(7);
//        }
//        return redirect('/access');

       return view('access.create',compact(['users','pages']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'pid' => 'required|exists:pages,id',
            'uid'=> 'required|exists:users,id',

        ]);

       User::find($request->uid)->pages()->attach($request->pid);
        //detach
        return redirect('/access');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = User::findOrFail($id);
        return view('access.update',compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nid' => 'required|exists:pages,id',
            'oid' => 'required|exists:pages,id',
            'uid'=> 'required|exists:users,id',

        ]);

        $user=User::find($request->uid);

        $user->pages()->attach($request->nid);
        $user->pages()->detach($request->oid);
        return redirect('/access');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //$user->pages()->detach();
    }
}
