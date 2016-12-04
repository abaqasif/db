<?php

namespace App\Http\Controllers;

use App\Party;
use App\Stock;
use Illuminate\Http\Request;

use App\Http\Requests;

class PartyController extends Controller
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
        return view('party.index',compact('party'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('party.create');
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
            'mobile'=> ['numeric','required','regex:/(03)[0-9]{9}/'],
            'balance'=>'numeric|required',
            'open_balance'=>'numeric|required',
            'credit_limit'=>'numeric|required',
            'sale_id'=>'required|exists:salesmens,id'

        ]);

           // echo $request;

        Party::create([
            'name'=>$request->name,'area'=>$request->area,'address'=>$request->address,
            'fax'=>$request->fax,'mobile'=>$request->mobile,'balance'=>$request->balance,'open_balance'=>$request->open_balance,
            'credit_limit'=>$request->credit_limit,'day'=>$request->day, 'salesmen_id'=>$request->sale_id,

         ]);
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
        $party = Party::findOrFail($id);
        return view('party.update',compact('party'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
            'mobile'=> ['required','regex:/(03)[0-9]{9}/'],
            'balance'=>'numeric|required',
            'open_balance'=>'numeric|required',
            'credit_limit'=>'numeric|required',
            'sale_id'=>'exists:salesmens,id'
            //'sale_id'=>'exists:salesmens,id',

        ]);



        $party = Party::FindOrFail($id);

       $party->update([
            'name'=>$request->name,'area'=>$request->area,'address'=>$request->address,
            'fax'=>$request->fax,'mobile'=>$request->mobile,'balance'=>$request->balance,'open_balance'=>$request->open_balance,
            'credit_limit'=>$request->credit_limit,'day'=>$request->day,'salesmen_id'=>$request->sale_id,

        ]);
        return redirect('/party');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $party = Party::FindOrFail($id);
        $party->delete();
        return redirect('/party');
    }
}
