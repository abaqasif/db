<?php

namespace App\Http\Controllers;

use App\Salesmen;
use Illuminate\Http\Request;

use App\Http\Requests;

class SalesmenController extends Controller
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
        $salesmen = Salesmen::all();
        return view('salesmen.index',compact('salesmen'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salesmen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $sale = Salesmen::FindOrFail('1');
       echo $request;

        $this->validate($request,[
            'cell'=> ['required','regex:/(03)[0-9]{9}/'],
            //'Party_id'=>'exists:parties,id'

        ]);

        Salesmen::create(['name'=>$request->name,'cell'=>$request->cell,'cell_other'=>$request->cell_other,'sleep'=>(int)$request->optradio]);
        return redirect('/salesmen');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Salesmen::findOrFail($id);
        return view('salesmen.update',compact('sale'));
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
            'cell'=> ['numeric','required','regex:/(03)[0-9]{9}/'],
          //  'cell_other'=> ['regex:/(03)[0-9]{9}/'],

        ]);

        $sale = Salesmen::findOrFail($id);

        $sale->update(['name'=>$request->name,'cell'=>$request->cell,'cell_other'=>$request->cell_other,'sleep'=>(int)$request->optradio]);

        return redirect('/salesmen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Salesmen::findOrFail($id);
        $sale->delete();
        return redirect('/salesmen');
    }
}
