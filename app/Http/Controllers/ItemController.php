<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Filling;
use App\Item;
use App\Packing;
use App\Recipe;
use Illuminate\Http\Request;

use App\Http\Requests;

class ItemController extends Controller


{


   public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('page_access');
      //  $this->middleware('productionAdmin');
    }
    //
    /**
     * @return string
     */
    public function home(){
        $items = Item::all();
        $item = null;
        return view('Item.get_item',compact('items' ,'item','filling' , 'batch' ,'recipe' ,'packing' ));
    }

    public function rtrv_item(Request $request){
      //  dd($request);
        $this->validate($request,[
            'item'=>'required|numeric',
        ]);
       $items = Item::all();
        $item = Item::find($request->item);
        $filling = Filling::find($item->filling_id);
        $batch = Batch::find($filling->batch_id);
        $recipe = Recipe::find($batch->recipe_id);
$packing  = Packing::find($filling->packing_id);
//        echo $item . "<br>";
//        echo $filling . "<br>";
//        echo $batch. "<br>";
//        echo $recipe . "<br>";

      return view('Item.get_item' , compact( 'items','item','filling' , 'batch' ,'recipe' ,'packing'));
}
}
