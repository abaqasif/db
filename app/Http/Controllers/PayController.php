<?php

namespace App\Http\Controllers;

use App\Party;
use App\Pay;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
       // $this->middleware('isAdmin');
         $this->middleware('page_access');
    }

    public function index()
    {
         $party = Party::all();
//      return $orders->foo;
        //return 'whay';
        return view('payment.create', compact('party'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'token' => 'numeric',
            'cash'=> 'numeric',
            'cheque'=> 'numeric',


        ]);
        $so = Pay::create(['total'=>'0','pdate'=>Carbon::now(),'party_id'=>$request->input('pid'),'token'=>$request->token,'cash'=>$request->cash,'cheque'=>$request->cheque]);
        $so->total = $so->cash + $so->token+$so->cheque ;
        $so->save();
        $party= Party::find($request->input('pid'));
        $party->balance = $party->balance - $so->total;
        $party->save();
        return redirect('/party');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
