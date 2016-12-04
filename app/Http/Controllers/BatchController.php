<?php

namespace App\Http\Controllers;

use App\Raw_Material;
use App\Recipe;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Batch;
use App\BatchDetail;
//use Carbon\Carbon;

class BatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
         $this->middleware('page_access');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $batches = Batch::all();
        return view('Batch.home', compact('batches'));

    }
//to store additional raw materials
    public function additional_rm($id , Request $request){

//
        $this->validate($request,[
            'rm_code'=>'required',
            'qty'=>'required|numeric',
        ]);

        $rm =  \DB::table('raw_materials')->where('rm_code',  '=' , $request->rm_code)->get();
$qty =   \DB::table('raw_materials')->where('rm_code',  '=' , $request->rm_code)->select('qty_available')->get();

//    if($request->qty < $qty[0]->qty_available) {
            \DB::table('raw_materials')->where('rm_code', '=', $request->rm_code)
                ->update(['qty_available' => round($qty[0]->qty_available - $request->qty)]);

            $bd = new BatchDetail;
            $bd->qty = $request->qty;
            $bd->rm_Code = $request->rm_code;
            $bd->batch_id = $id;
            $bd->amount = ($rm[0]->rate) * ($request->qty);
            $bd->save();

    //  }

return redirect('/production/batch/'.$id.'/complete_batch');

    }



    public function create()
    {

        $items  = \App\Recipe::select('id','brand','type', 'shade')->get();
        return view('Batch.item_list' , compact('items'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function batch_done(Request $request , $id){

        $rm = $request->rm;
        $additional = $request->additional;

        for ($i = 0; $i<count($request->rm); $i++)
        {
            $raw_m = \DB::table('raw_materials')->where('rm_code' , '=' , $rm[$i])->get();

            $bd = \DB::table('batch_details')->where('batch_id' , '=' , $id)
                ->where('rm_code','=',$raw_m[0]->rm_code)->get();

            $amount = $bd[0]->amount;

            if($additional[$i]!=null) {
                $qty =   \DB::table('raw_materials')->where('rm_code',  '=' , $raw_m[0]->rm_code)->select('qty_available')->get();

                if($additional[$i] > $qty) {
                    \DB::table('raw_materials')->where('rm_code', '=', $request->rm_code)
                        ->update(['qty_available' => $qty - $additional[$i]]);

                    \DB::table('batch_details')->where('batch_id', '=', $id)
                        ->where('rm_code', '=', $raw_m[0]->rm_code)
                        ->update([
                            'additional' => $additional[$i],
                            'amount' => $amount + ($additional[$i] * $raw_m[0]->rate)
                        ]);
                }
            }
            else if ($additional[$i]==null){


                \DB::table('batch_details')->where('batch_id' , '=' , $id)
                    ->where('rm_code','=',$raw_m[0]->rm_code)
                    ->update([
                        'additional' => 0 ,
                        'amount' => $amount
                    ]);
            }

        }
        return redirect('production/batch/'.$id);
    }


//to view when the batch is not done
public function complete_batch($id){
 $batch = Batch::find($id);
    $recipe = Recipe::find($batch->recipe_id);

    $rms = \DB::table('raw_materials')
        ->join('batch_details' , 'raw_materials.rm_code' ,'=', 'batch_details.rm_code' )
        ->select('raw_materials.rate' , 'raw_materials.uom',  'raw_materials.type', 'batch_details.*' )
        ->where('batch_details.batch_id' , '=' , $batch->id)
        ->get();
//echo $rms;
   return view('Batch.make_batch' , compact('batch','recipe','rms'));

}



    public function show($id)
    {
        $batch  = \App\Batch::find($id);
        $recipe = \App\Recipe::find($batch->recipe_id);


        $rms = \DB::table('raw_materials')
            ->join('batch_details' , 'raw_materials.rm_code' ,'=', 'batch_details.rm_code' )
            ->select('raw_materials.rate' , 'raw_materials.uom',  'raw_materials.type', 'batch_details.*' )
            ->where('batch_details.batch_id' , '=' , $batch->id)
            ->get();

         return view('Batch.show_batch' , compact('batch','recipe','rms'));


    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'item'=>'required',
            'size'=>'required',
            'gw'=>'required',
            'ew'=>'required',
            'order_no'=>'required',
        ]);
        $exist = \DB::table('recipes')->where('id', '=',$request->item)->exists();
        if($exist){
            $recipe = Recipe::find($request->item);

            $rms_of_recipe =  \DB::table('raw_materials')
                ->join('recipe_rm','raw_materials.rm_code','=','recipe_rm.rm_code')
                ->select('raw_materials.*','recipe_rm.qty','recipe_rm.rm_code',\DB::raw('recipe_rm.qty*raw_materials.rate AS amount'))
                ->where('recipe_rm.recipe_id','=',$recipe->id)
                ->get();

            //for the new batch
            $total_material = \DB::table('raw_materials')
                ->join('recipe_rm','raw_materials.rm_code','=','recipe_rm.rm_code')
                ->select('raw_materials.*','recipe_rm.qty','recipe_rm.rm_code',\DB::raw('recipe_rm.qty*raw_materials.rate AS amount'))
                ->where('recipe_rm.recipe_id','=',$request->item)
                ->sum('recipe_rm.qty');

            $total_amount = 0;

            foreach($rms_of_recipe as $rm){
                $total_amount += $rm->qty * $request->size * $rm->rate;
            }

            $batch = new Batch;
            $batch->recipe_id = $recipe->id;
            $batch->gross_weight = $request->gw;
            $batch->empty_weight = $request->ew;
            $batch->order_no = $request->order_no;
            $batch->created_by =  \Auth::user()->name;
            $batch->batch_size = $request->size;
            $batch->total_material = $total_material * $request->size;
            $batch->total_amount = $total_amount;
            $batch->num = $batch->order_no . "/" .  Carbon::now()->format('d-m-y') . "/" . $total_material;
            $batch->cost_per_unit = 0;
            $batch->updated_by = null;
         $batch->save();



            foreach($rms_of_recipe as $rm){
                $qty =   \DB::table('raw_materials')->where('rm_code',  '=' , $rm->rm_code)->select('qty_available')->get();
                $used_qty = $rm->qty*$request->size;

                if($request->qty*$request->size < $qty[0]->qty_available) {

                    \DB::table('raw_materials')->where('rm_code', '=', $rm->rm_code)
                        ->update(['qty_available' => $qty[0]->qty_available  - $used_qty * $request->size]);
                    $bd = new BatchDetail;
                    $bd->qty = $rm->qty * $request->size;
                    $bd->amount = $rm->qty * $request->size * $rm->rate;
                    $bd->batch_id = $batch->id;
                    $bd->rm_code = $rm->rm_code;
                    $bd->save();
                }
            }
         return redirect('/production/batch/'.$batch->id.'/complete_batch');



        }

        else{
            echo "recipe does not exist";
        }


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exist = \DB::table('fillings')->where('batch_id' , '=' , $id)->exists();
        if(!$exist) {
            $batch = \App\Batch::find($id);
            $recipe = \App\Recipe::find($batch->recipe_id);


            $rms = \DB::table('raw_materials')
                ->join('batch_details', 'raw_materials.rm_code', '=', 'batch_details.rm_code')
                ->select('raw_materials.rate', 'raw_materials.uom', 'raw_materials.type', 'batch_details.*')
                ->where('batch_details.batch_id', '=', $batch->id)
                ->get();

            return view('Batch.update_home', compact('batch', 'recipe', 'rms'));
        }
        return redirect()->back();
    }

    public function update_header($id){
        $exist = \DB::table('fillings')->where('batch_id' , '=' , $id)->exists();
        if(!$exist) {
            $batch = Batch::find($id);
            return view('Batch.update_header' , compact('batch'));

        }
        return redirect()->back();
    }

    public function update_add($id1,$id2){
        //dd($id1);
        //dd($id2);
        $bd = \DB::table('batch_details')->where('batch_id' , '=' , $id1)
            ->where('rm_code','=',$id2)->get();
        $batch = Batch::find($id1);
        return view('Batch.update_add' , compact('bd', 'batch'));
    }

    public function update_rm($id1,$request){

        $this->validate($request,[
            'rm_code'=>'required',
            'qty'=>'required|numeric|between:0,99999999999999.99',
        ]);

        $qty =   \DB::table('raw_materials')->where('rm_code',  '=' , $request->rm_code)->select('qty_available')->get();

        if( $request->qty > $qty) {
            \DB::table('raw_materials')->where('rm_code', '=', $request->rm_code)
                ->update(['qty_available' => $qty - $request->qty]);

            $rm = Raw_Material::where('rm_code', '=', $request->rm_code)->get();
            $batch = Batch::find($id1);
            $bd = new BatchDetail;
            $bd->qty = $request->qty;
            $bd->rm_code = $request->rm_code;
            $bd->amount = $bd->qty * $rm->rate * $batch->batch_size;
            $bd->save();
        }
      //  echo "poop";
        //return redirect('/production/batch/'.$batch->id.'/update_home');
return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function header_update_store(Request $request, $id)
    {
        $this->validate($request,[
            'item'=>'required',
            'size'=>'required',
            'gw'=>'required',
            'ew'=>'required',
            'order_no'=>'required',
        ]);

        $exist = \DB::table('fillings')->where('batch_id' , '=' , $id)->exists();
        if(!$exist) {

            \DB::table('batches')->where('id' , '=' , $id)
                ->update([
                    'gross_weight' =>$request->gw,
                    'empty_weight' =>$request->ew,
                    'order_no' =>$request->order_no
                ]);

            return redirect('production/batch/'.$id);

        }
        else {
            return redirect()->back();

        }
    }
    public function rm_update_store(Request $request, $id1,$id2)
    {
        $this->validate($request,[
            'qty'=>'required|numeric|between:0,99999999999999.99',
        ]);

        $exist = \DB::table('fillings')->where('batch_id' , '=' , $id1)->exists();

        if(!$exist) {
$prev_qty = \DB::table('batch_details')->where('batch_id', '=', $id1)->where('rm_code', '=', $id2)->select('additional')->get();
            $qty =   \DB::table('raw_materials')->where('rm_code',  '=' , $id2)->select('qty_available')->get();

            if( $request->qty > $qty) {
                \DB::table('raw_materials')->where('rm_code', '=', $id2)
                    ->update(['qty_available' => $qty + $prev_qty - $request->qty]);

                \DB::table('batch_details')->where('batch_id', '=', $id1)->where('rm_code', '=', $id2)
                    ->update([
                        'additional' => $request->qty,
                    ]);
            }
           // return redirect()->back();
          return redirect('/production/batch/'.$id1.'/edit');

        }
        else {
            return redirect()->back();

        }
    }


    public function delete_rm($id1,$id2){

        \DB::table('batch_details')->where('batch_id' , '=' , $id1)
            ->where('rm_code' , '=', $id2)->delete();
        return redirect('/production/batch/'.$id1.'/complete_batch');


    }

    public function delete_update($id1,$id2){

        \DB::table('batch_details')->where('batch_id' , '=' , $id1)
            ->where('rm_code' , '=', $id2)->delete();

        return redirect()->back();


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exist = \DB::table('fillings')->where('batch_id' , '=' , $id)->exists();
if(!$exist) {
    \DB::table('batch_details')->where('batch_id', '=', $id)->delete();
    \DB::table('batches')->where('id', '=', $id)->delete();

}
        return redirect()->back();
    }
}
