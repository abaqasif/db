<?php

namespace App\Http\Controllers;

use App\Goods_return;
use App\Party;
use App\Sales_order;
use App\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    //    $this->middleware('productionAdmin');
        $this->middleware('page_access');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $return = Goods_return::all();
        return view('return.show', compact('return'));
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
        $validaters = Validator::make($request->all(), [
            'qty.*' => 'numeric',
            'discount.*' => 'numeric',

        ]);
        if($validaters->fails()){
            return back();
//                ->withErrors($validaters)
//                ->withInput();
            // return redirect('order/create')->withErrors($validator);
        }
        $gr = Goods_return::create(['total'=>'0','rdate'=>Carbon::now(),'party_id'=>$request->input('pid')]);
        // return $so;
        //return $gr;
        $item =$request->input('item');
        $quantity =$request->input('qty');
        $disc =$request->input('discount');
        $i =0;
        $total = 0;
        $j=0;
        $pt = Party::find($request->input('pid'));

        foreach($disc as $it ) { $disc[$j] =  1 - ($disc[$j]/100) ; $j++; }
        //return $disc;
        foreach ($item as $it ){
            $stock = Stock::find($it);
            $rate = $stock->rate;
            //updating Quantity in stock
            $stock->quantity = $stock->quantity + $quantity[$i];
            $stock->save();
            // getting total for order
            $total=$total + $rate*$quantity[$i]*$disc[$i];
            // making relation
            $gr->stock()->attach($it, ['quantity' => $quantity[$i],'discount' => ((1-$disc[$i])*100)]);
            $i++;
        }
        $pt->balance = $pt->balance - $total;
        $pt->save();
        $gr->total = $total;
        $gr->save();
        return  redirect('/return');




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    $party= Party::find($id);
   return view('return.index',compact('party'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $order= Sales_order::find($id);
     //$party = $order->party;
        return view('return.create',compact('order'));



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
        echo 'upda';

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
        echo 'wa';

    }
}
