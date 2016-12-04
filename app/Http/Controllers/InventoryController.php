<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InventoryController extends Controller
{
    // public function __construct()
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('page_access');
      //  $this->middleware('productionAdmin');
    }
    public function index(){
        $stocks = \DB::table('fg_inventories')
            ->join('stocks' , 'fg_inventories.stock_id', '=', 'stocks.id')
            ->select('fg_inventories.id' , 'stocks.brand', 'stocks.type' , 'stocks.shade' ,'stocks.pack_size' ,
                'fg_inventories.price', 'fg_inventories.open_bal', 'fg_inventories.factory' , 'fg_inventories.warehouse' )
            ->get();


        return view('Inventory.controller' , compact('stocks'));
    }

    public function transfer_to_warehouse(Request $request){
        $this->validate($request,[
            'item'=>'required|numeric',
            'qty'=>'required|numeric',
        ]);
        $entry =     \DB::table('fg_inventories')->where('id' , '=' , $request->item)->get();
        $factory = $entry[0]->factory;
        $warehouse = $entry[0]->warehouse;

        \DB::table('fg_inventories')->where('id' , '=' , $request->item)
            ->update([
                'factory' => $factory - $request->qty,
                'warehouse' => $warehouse + $request->qty
            ]);
        $entry1 =  \DB::table('fg_inventories')->where('id' , '=' , $request->item)->get();
        \DB::table('stocks')->where('id','=' , $entry1[0]->stock_id)
            ->update(['quantity' => $entry1[0]->warehouse]);

        return redirect('/inventory');
    }


}
