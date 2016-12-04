<?php

namespace App\Http\Controllers;

use App\Raw_Material;
use App\Wastage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;


class WastageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('page_access');

    }
    public function index()
    {


        $wastes = \DB::table('raw_materials')
            ->join('wastages' , 'raw_materials.rm_code', '=', 'wastages.rm_code')
            ->select('wastages.*' ,'raw_materials.rate', 'raw_materials.type')
            ->get()->toArray();
        return view('Wastage.home' , compact('wastes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $rms = \DB::table('raw_materials')->get();
        return view('Wastage.create' , compact('rms'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[
            'rm_code'=>'required',
            'qty'=>'required|numeric|between:0,99999999999999.99',
            'remarks' => 'required',
        ]);


        $rm =\DB::table('raw_materials')->where('rm_code' , '=' , $request->rm_code)->get();

$waste = new Wastage;
        $waste->rm_code = $request->rm_code;
        $waste->date = Carbon::now()->toDateString();
        $waste->qty = $request->qty;
        $waste->cost = $request->qty *  $rm[0]->rate;
        $waste->remarks = $request->remarks;

$waste->save();

        return redirect(route('wastage.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $rms = \DB::table('raw_materials')->get();
        $waste = Wastage::find($id);
        return view('Wastage.update' , compact('waste','rms'));

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
            'qty'=>'required|numeric|between:0,99999999999999.99',
        ]);

        $rm = \DB::table('raw_materials')->where('rm_code' , '=' , $request->rm_code)->get();
$waste = Wastage::find($id);
        $waste->rm_code = $request->rm_code;
        $waste->date = Carbon::now()->toDateString();
        $waste->qty = $request->qty;
        $waste->cost = $request->qty *  $rm[0]->rate;
        $waste->remarks = $request->remarks;
        $waste->save();
        return redirect(route('wastage.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $waste = Wastage::find($id)->delete();
        return redirect(route('wastage.index'));

    }
}
