<?php
//
//                  ADD DISCOUNT FEATURE
//                  HAVE TO ADD REPORT BUTTON ON SALES
//                  HAVE TO PUT VALIDATION
//
namespace App\Http\Controllers;

use App\Party;
use App\Sales_order;
use App\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
//use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Input;
use Validator;

//use Illuminate\Validation\Validator;
//use Illuminate\Validation\Validator;

//use Illuminate\Support\Facades\Validator;

class salesController extends Controller
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
     $orders = Sales_order::all();
//      return $orders->foo;
      //return 'whay';
     return view('sales_order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $message ='';
        $parties = DB::table('parties')
            ->orderBy('name', 'asc')
            ->get();
        $stock= Stock::all();
        return view('sales_order.create', compact('parties','stock','message'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //validation added
    public function store(Request $request)
    {
        //dd(Input::all());

        $validaters = Validator::make($request->all(), [
            'jel_label.*' => 'numeric',
            'jel_coa_id.*' => 'numeric',

        ]);
        if($validaters->fails()){
            return redirect('order/create');
//                ->withErrors($validaters)
//                ->withInput();
           // return redirect('order/create')->withErrors($validator);
        }


      $so = Sales_order::create(['total'=>'0','sdate'=>Carbon::now(),'party_id'=>$request->input('pid')]);
       // return $so;
        $credit_limit = Party::find($request->input('pid'))->credit_limit;
        $pt = Party::find($request->input('pid'));
        $balance = Party::find($request->input('pid'))->balance;

   $item =$request->input('jel_reference');
   $quantity =$request->input('jel_label');
   $disc =$request->input('jel_coa_id');
   $i =0; $j=0;
   $total = 0;
        foreach($disc as $it ) { echo $disc[$j] =  1 - ($disc[$j]/100) ; $j++; }
        //$j=0;
     foreach ($item as $it ){
         $stock = Stock::find($it);
         $rate = $stock->rate;
         //updating Quantity in stock
         $stock->quantity = $stock->quantity - $quantity[$i];
         $stock->save();
         // getting total for order and applying discount
         $total=$total + $rate*$quantity[$i]*$disc[$i];
         // making relation
         $so->stock()->attach($it, ['quantity' => $quantity[$i],'discount' => ((1-$disc[$i])*100)]);
         $i++;
     }
     $i=0;
     $pt->balance =  $pt->balance + $total;
      $pt->save();
     $so->total = $total;
     $so->save();

     // checking if sales order exceeds
        if($credit_limit<$balance){

            foreach ($item as $it ){
                $stock = Stock::find($it);
                $stock->quantity = $stock->quantity + $quantity[$i];
                $stock->save();
                $i++;
            }
            $so->delete();
            $parties = DB::table('parties')
                ->orderBy('name', 'asc')
                ->get();
            $message = 'Credit limit exceeded. Cannot make a new sales order';
            $stock= Stock::all();
            return view('sales_order.create', compact('parties','stock','message'));


        }

     return redirect('/order');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Sales_order::findOrFail($id);
        if($order->ddate== null){
        $order->ddate = Carbon::now();
        $order->save();
        }
        return redirect('/order');
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
        $order = Sales_order::findOrFail($id);
        foreach($order->stock as $st){
            $stock = Stock::find($st->id);
             $qt = $st->pivot->quantity;
             $stock->quantity =$stock->quantity + $qt ;
            //echo "        ";
             $stock->save();
            //echo "        ";


        }

        $order->delete();
        //$order->delete();
        return redirect('/order');

        // redirect('/users');
    }
}
