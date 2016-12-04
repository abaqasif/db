<?php
namespace App\Http\Controllers;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Filling;
use App\Stock;
use App\FGInventory;
use App\Batch;
use App\Packing;
class FillingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('page_access');
      //  $this->middleware('productionAdmin');
    }
    public function home($id)
    {
        $fills = \DB::table('fillings')
            ->join('packings', 'packings.id', '=', 'fillings.packing_id')
            ->where('batch_id', '=', $id)
            ->select('fillings.*', 'packings.name', 'packings.weight AS pck_weight')
            ->get();
        $total_fill = 0;
        foreach ($fills as $fill){
            $total_fill += $fill->weight;
    }
$filling_date = Batch::where('id', '=', $id)->select('filling_date')->get();
       $batch = Batch::find($id);
        return view('Batch.Filling.home', compact('batch', 'fills','filling_date' , 'total_fill'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function lock($id){


        $batch = Batch::find($id);


        $recipe = \DB::table('recipes')->where('id' , '=' , $batch->recipe_id)->get();

        $drum_exist = \DB::table('stocks')
            ->where('brand' , '=' , $recipe[0]->brand)
            ->where('type' , '=' , $recipe[0]->type)
            ->where('shade' , '=' , $recipe[0]->shade)
            ->where('pack_size' , '=' , 'drum')->exists();

        $quarter_exist = \DB::table('stocks')
            ->where('brand' , '=' , $recipe[0]->brand)
            ->where('type' , '=' , $recipe[0]->type)
            ->where('shade' , '=' , $recipe[0]->shade)
            ->where('pack_size' , '=' , 'quarter')->exists();

        $gallon_exist = \DB::table('stocks')
            ->where('brand' , '=' , $recipe[0]->brand)
            ->where('type' , '=' , $recipe[0]->type)
            ->where('shade' , '=' , $recipe[0]->shade)
            ->where('pack_size' , '=' , 'gallon')->exists();

        $drums = \DB::table('fillings')
            ->join('packings' ,  'packings.id' , '=' ,'fillings.packing_id')
            ->where('batch_id', '=', $id)
            ->select('fillings.*' , 'packings.name' , 'packings.weight AS pck_weight')
            ->where('packings.name' , '=' , 'drum')
            ->get()->toArray();




        if($drums==null) {
            $n = 0;
        }
        else {


            $n = $drums[0]->qty;

            if($drum_exist){
                $drum_stock = \DB::table('stocks')
                    ->where('brand' , '=' , $recipe[0]->brand)
                    ->where('type' , '=' , $recipe[0]->type)
                    ->where('shade' , '=' , $recipe[0]->shade)
                    ->where('pack_size' , '=' , 'drum')
                    ->get();

                $inv = \DB::table('fg_inventories')
                    ->where('stock_id' , '=' , $drum_stock[0]->id)
                    ->get();

                \DB::table('fg_inventories')
                    ->where('stock_id' , '=' , $drum_stock[0]->id)
                    ->update([
                        'factory' => $inv[0]->factory + $n
                    ]);
            }
            else {
                $stock = new Stock;
                $stock->pack_size = 'drum';
                $stock->quantity = 0;
                $stock->type = $recipe[0]->type;
                $stock->brand = $recipe[0]->brand;
                $stock->shade = $recipe[0]->shade;
                $stock->rate = 1230;
                $stock->open_bal = 0;
                $stock->save();

                $stk = \DB::table('stocks')
                    ->where('brand' , '=' , $recipe[0]->brand)
                    ->where('type' , '=' , $recipe[0]->type)
                    ->where('shade' , '=' , $recipe[0]->shade)
                    ->where('pack_size' , '=' , 'drum')
                    ->get();

                $inv = new FGInventory;
                $inv->factory = $n;
                $inv->warehouse = 0;
                $inv->open_bal = 0;
                $inv->price = 1230;
                $inv->stock_id = $stk[0]->id;
                $inv->save();
            }
            for ($x = 0; $x < $n; $x++) {

                $item = new Item;
                $item->inv_id = $inv[0]->id;
                $item->filling_id = $drums[0]->id;
                $item->active = false;
                $item->cost_price = 00000;
                $item->price = 1230;
                $item->save();


            }
        }







        $quarters = \DB::table('fillings')
            ->join('packings' ,  'packings.id' , '=' ,'fillings.packing_id')
            ->where('batch_id', '=', $id)
            ->select('fillings.*' , 'packings.name' , 'packings.weight AS pck_weight')
            ->where('packings.name' , '=' , 'quarter')
            ->get()->toArray();



        if($quarters==null) {
            $n = 0;
        }
        else {

            $n = $quarters[0]->qty;

            if($quarter_exist){
                $qtr_stock = \DB::table('stocks')
                    ->where('brand' , '=' , $recipe[0]->brand)
                    ->where('type' , '=' , $recipe[0]->type)
                    ->where('shade' , '=' , $recipe[0]->shade)
                    ->where('pack_size' , '=' , 'quarter')
                    ->get();

                $inv = \DB::table('fg_inventories')
                    ->where('stock_id' , '=' , $qtr_stock[0]->id)
                    ->get();

                \DB::table('fg_inventories')
                    ->where('stock_id' , '=' , $qtr_stock[0]->id)
                    ->update([
                        'factory' => $inv[0]->factory + $n
                    ]);

            }
            else {
                $stock = new Stock;
                $stock->pack_size = 'quarter';
                $stock->quantity = 0;
                $stock->type = $recipe[0]->type;
                $stock->brand = $recipe[0]->brand;
                $stock->shade = $recipe[0]->shade;
                $stock->rate = 4560;
                $stock->open_bal = 0;
                $stock->save();

                $stk = \DB::table('stocks')
                    ->where('brand' , '=' , $recipe[0]->brand)
                    ->where('type' , '=' , $recipe[0]->type)
                    ->where('shade' , '=' , $recipe[0]->shade)
                    ->where('pack_size' , '=' , 'quarter')
                    ->get();

                $inv = new FGInventory;
                $inv->factory = $n;
                $inv->warehouse = 0;
                $inv->open_bal = 0;
                $inv->price = 4560;
                $inv->stock_id = $stk[0]->id;
                $inv->save();
            }
            $qtr_stock = \DB::table('stocks')
                ->where('brand' , '=' , $recipe[0]->brand)
                ->where('type' , '=' , $recipe[0]->type)
                ->where('shade' , '=' , $recipe[0]->shade)
                ->where('pack_size' , '=' , 'quarter')
                ->get();

            $inv = \DB::table('fg_inventories')
                ->where('stock_id' , '=' , $qtr_stock[0]->id)
                ->get();

            for ($x = 0; $x < $n; $x++) {
                $item = new Item;
                $item->filling_id = $quarters[0]->id;
                $item->inv_id = $inv[0]->id;
                $item->active = false;
                $item->cost_price = 00000;
                $item->price = 4560;
                $item->save();
            }

        }



        $gallons = \DB::table('fillings')
            ->join('packings' ,  'packings.id' , '=' ,'fillings.packing_id')
            ->where('batch_id', '=', $id)
            ->select('fillings.*' , 'packings.name' , 'packings.weight AS pck_weight')
            ->where('packings.name' , '=' , 'gallon')
            ->get()->toArray();

        if($gallons==null) {
            $n = 0;

        }
        else {
            $n = $gallons[0]->qty;

            if($gallon_exist){
                $gallon_stock = \DB::table('stocks')
                    ->where('brand' , '=' , $recipe[0]->brand)
                    ->where('type' , '=' , $recipe[0]->type)
                    ->where('shade' , '=' , $recipe[0]->shade)
                    ->where('pack_size' , '=' , 'gallon')
                    ->get();

                $inv = \DB::table('fg_inventories')
                    ->where('stock_id' , '=' , $gallon_stock[0]->id)
                    ->get();

                \DB::table('fg_inventories')
                    ->where('stock_id' , '=' , $gallon_stock[0]->id)
                    ->update([
                        'factory' => $inv[0]->factory + $n
                    ]);

            }
            else{


                $stock = new Stock;
                $stock->pack_size = 'gallon';
                $stock->quantity = 0;
                $stock->type = $recipe[0]->type;
                $stock->brand =$recipe[0]->brand;
                $stock->shade = $recipe[0]->shade;
                $stock->rate = 1230;
                $stock->open_bal = 0;
                $stock->save();

                $stk = \DB::table('stocks')
                    ->where('brand' , '=' , $recipe[0]->brand)
                    ->where('type' , '=' , $recipe[0]->type)
                    ->where('shade' , '=' , $recipe[0]->shade)
                    ->where('pack_size' , '=' , 'gallon')
                    ->get();

                $inv = new FGInventory;
                $inv->factory = $n;
                $inv->warehouse = 0;
                $inv->open_bal = 0;
                $inv->price = 7890;
                $inv->stock_id = $stk[0]->id;
                $inv->save();
            }
            $gallon_stock = \DB::table('stocks')
                ->where('brand' , '=' , $recipe[0]->brand)
                ->where('type' , '=' , $recipe[0]->type)
                ->where('shade' , '=' , $recipe[0]->shade)
                ->where('pack_size' , '=' , 'gallon')
                ->get();

            $inv = \DB::table('fg_inventories')
                ->where('stock_id' , '=' , $gallon_stock[0]->id)
                ->get();

            for ($x = 0; $x < $n; $x++) {

                $item = new Item;
                $item->inv_id = $inv[0]->id;
                $item->filling_id = $gallons[0]->id;
                $item->active = false;
                $item->cost_price = 00000;
                $item->price = 7890;
                $item->save();

            }
        }





        $batch->filling_lock = true;
        $batch->save();

        return redirect('/production/batch/'.$id.'/fill');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($id)
    {
        $batch = Batch::find($id);
$packing = Packing::all();
        $fills = \DB::table('fillings')
            ->join('packings', 'packings.id', '=', 'fillings.packing_id')
            ->where('batch_id', '=', $id)
            ->select('fillings.*', 'packings.name', 'packings.weight AS pck_weight')
            ->get();
        $total_fill = 0;
        foreach ($fills as $fill){
            $total_fill += $fill->weight;
        }
        return view('Batch.Filling.create',compact('total_fill' , 'batch','packing'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id , Request $request)
    {
        $this->validate($request,[

            'qty'=>'required|numeric',

        ]);

        $batch = Batch::find($id);
        $fills = \DB::table('fillings')
            ->join('packings', 'packings.id', '=', 'fillings.packing_id')
            ->where('batch_id', '=', $id)
            ->select('fillings.*', 'packings.name', 'packings.weight AS pck_weight')
            ->get();

        $total_fill = 0;
        foreach ($fills as $fill){
            $total_fill += $fill->weight;
        }
            $pack = Packing::find($request->pck);

            $exist = \DB::table('fillings')->where('packing_id', '=', $pack->id)
                ->where('batch_id', '=', $id)->exists();

        $add_weight = $request->qty * $pack->weight;
        $batch_left = $batch->gross_weight - $total_fill - $batch->empty_weight;
if($add_weight<$batch_left)
{
    if ($exist) {

        $fill = Filling::where('packing_id', '=', $pack->id)
            ->where('batch_id', '=', $id)->get();
        $qty = $fill[0]->qty + $request->qty;


        \DB::table('fillings')->where('packing_id', '=', $pack->id)
            ->where('batch_id', '=', $id)
            ->update([
                'qty' => $qty,
                'weight' => $qty * $pack->weight,
            ]);

    } else {
        $fill = new Filling;
        $fill->packing_id = $pack->id;
        $fill->qty = $request->qty;
        $fill->weight = $request->qty * $pack->weight;
        $fill->unit = 'ltr';
        $fill->batch_id = $id;
        $fill->save();
    }

}
        return redirect('/production/batch/' . $id . '/fill');
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
    public function edit($id1,$id2)
    {
        $filling = \DB::table('fillings')
            ->join('packings' , 'fillings.packing_id' , '=' , 'packings.id')
            ->where('fillings.batch_id' , '=' , $id1)
            ->where('fillings.id' , '=' , $id2)
            ->select('fillings.*', 'packings.name', 'packings.weight AS pck_weight')
            ->get();
        return view('Batch.Filling.update',compact('filling'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id1,$id2)
    {
        $filling = Filling::find($id2);
        $batch = Batch::find($id1);

        $fills = \DB::table('fillings')
            ->join('packings', 'packings.id', '=', 'fillings.packing_id')
            ->where('batch_id', '=', $id1)
            ->select('fillings.*', 'packings.name', 'packings.weight AS pck_weight')
            ->get();

        $total_fill = 0;
        foreach ($fills as $fill){
            $total_fill += $fill->weight;
        }

$packing = \DB::table('packings')->where('id','=',$filling->packing_id)->get();

        $add_weight = $request->qty * $packing[0]->weight;
        $batch_left = $batch->gross_weight - $total_fill - $batch->empty_weight;

        if($add_weight<$batch_left) {
            $filling->qty = $request->qty;
            $filling->weight = $packing[0]->weight * $request->qty;
            $filling->save();
        }
        return redirect('/production/batch/'.$id1.'/fill');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id1,$id2)
    {
        Filling::find($id2)->delete();
        return redirect('/production/batch/'.$id1.'/fill');
    }
}