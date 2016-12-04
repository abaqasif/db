<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Filling;
use Barryvdh\DomPDF\Facade as PDF;;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReportController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    //    $this->middleware('productionAdmin');
        $this->middleware('page_access');
    }
    //
    public function dpr_home(){
        return view('Reports.dpr_home');
    }

    public function get_dpr(Request $request){

        $this->validate($request,[
            'to_date'=>'required',
            'from_date'=>'required',
        ]);

        $to = strtotime($request->to_date);
        $to_date = date('d-m-y',$to);

        $from = strtotime($request->from_date);
        $from_date = date('d-m-y',$from);

        echo "<br>";




        $rows = \DB::table('recipes')
            ->join('batches' , 'batches.recipe_id' , '=' , 'recipes.id')
            ->join('fillings' , 'fillings.batch_id' ,'=' ,'batches.id')
            ->select('batches.id AS batch_id', 'recipes.*' ,  'batches.num' ,'fillings.id as filling_id', 'fillings.weight' , 'fillings.unit', 'batches.created_at AS batch_pdate' ,
                'fillings.created_at AS fill_pdate')
            ->get();
//
        $arr = array();
        foreach($rows as $row){
            $pdate = date('d-m-y',strtotime($row->fill_pdate));



            if($to_date == $pdate) {


                $entry = \DB::table('recipes')
                    ->join('batches' , 'batches.recipe_id' , '=' , 'recipes.id')
                    ->join('fillings' , 'fillings.batch_id' ,'=' ,'batches.id')
                    ->select('batches.id AS batch_id', 'recipes.*' ,  'batches.num' ,'fillings.id as filling_id', 'fillings.weight' , 'fillings.unit', 'batches.created_at AS batch_pdate' ,
                        'fillings.created_at AS fill_pdate')
                    ->where('fillings.id' , '=' , $row->filling_id)
                    ->get()->toArray();

                array_push($arr , $entry);
            }

        }

        $date = Carbon::now()->format('d M Y');
        $pdf = PDF::loadView('Reports.daily_production',array('arr' => $arr ,'to_date' => $to_date ,
            'from_date' => $from_date , 'pdate' => $pdate , 'date' => $date ));
        return $pdf->download('dpr_'.$date.'.pdf');

//return view('Reports.daily_production' , compact('arr' , 'to_date' , 'from_date' , 'pdate'));
    }

    public function mixing_home(){
        return view('Reports.mp_home');
    }
    public function mixing_cost_home(){
        return view('Reports.mpwc_home');
    }

    public function get_mixing_paper(Request $request){
        $this->validate($request,[

            'batch_num'=>'required',

        ]);
        $batch = Batch::where('num' , '=' , $request->batch_num)->get();

        $recipe= \DB::table('recipes')
            ->join('batches' , 'batches.recipe_id' , '=' , 'recipes.id')
            ->where('batches.id' , '=' ,  $batch[0]->id)
            ->get();

//        $bds = \DB::table('batch_details')
//            ->where('batch_id' , '=' , $batch[0]->id)
//            ->select('id' , 'additional' , 'qty' ,
//               \DB::raw("additional+qty AS total"),
//               // \DB::raw("additional+qty*100/sum(total) AS %age"),
//                'rm_code')
//            ->get();

        $sum_add = \DB::table('batch_details')->where('batch_id', '=', $batch[0]->id)
            ->sum('additional');
        $sum_qty = \DB::table('batch_details')->where('batch_id', '=', $batch[0]->id)
            ->sum('qty');
        $total_qty  = $sum_add + $sum_qty;
        $bds = \DB::select("select id,rm_code,additional,qty, additional+qty AS total,
                    format(additional+qty*100/$total_qty,3) AS percentage 
                    from batch_details
                    where batch_id = ? 
                    group by id,rm_code,additional,qty,total"
            , [$batch[0]->id]);

        $fillings  = \DB::table('fillings')
            ->join('packings' , 'fillings.packing_id' , '=' ,'packings.id')
            ->where('fillings.batch_id' , '=' , $batch[0]->id)
            ->select('fillings.*' , 'packings.weight AS pkg_wt')
            ->get();

        $total_fill  = \DB::table('fillings')
            ->join('packings' , 'fillings.packing_id' , '=' ,'packings.id')
            ->where('fillings.batch_id' , '=' , $batch[0]->id)
            ->select('fillings.*' , 'packings.weight AS pkg_wt')
            ->sum('fillings.weight');

        $tests =  \DB::table('batch_test')
            ->join('tests' , 'batch_test.test_id' , '=' , 'tests.id')
            ->where('batch_test.batch_id' , '=' , $batch[0]->id)
            ->get();
        $date = Carbon::now()->format('d M Y');

        $pdf = PDF::loadView('Reports.mixing_paper',array('batch' => $batch ,'bds' => $bds ,
            'tests' => $tests , 'recipe' => $recipe , 'date' => $date , 'fillings' => $fillings , 'total_fill' => $total_fill));
        return $pdf->download('mixing_ppr_w/o_cost_'.$date.'.pdf');
        //  return view('Reports.mixing_paper' , compact('fillings' , 'tests' , 'recipe' , 'batch','bds'));
    }


    public function get_mixing_cost(Request $request){
        $this->validate($request,[

            'batch_num'=>'required',

        ]);
        $batch = \DB::table('batches')->where('num' , '=' , $request->batch_num)->get();
        $recipe= \DB::table('recipes')
            ->join('batches' , 'batches.recipe_id' , '=' , 'recipes.id')
            ->where('batches.id' , '=' ,  $batch[0]->id)
            ->get();

        $sum_add = \DB::table('batch_details')->where('batch_id', '=', $batch[0]->id)
            ->sum('additional');
        $sum_qty = \DB::table('batch_details')->where('batch_id', '=', $batch[0]->id)
            ->sum('qty');
        $total_cost = \DB::table('batch_details')->where('batch_id', '=', $batch[0]->id)
            ->sum('amount');
        // echo $batch[0]->num;
        $total_qty  = $sum_add + $sum_qty;
        $date = Carbon::now()->format('d M Y');

        $bds = \DB::select("select b.rm_code,r.name,b.qty,b.additional,additional+qty AS total,
                      format(qty*100/$total_qty,3) AS percentage_qty, r.rate,b.amount , format(b.amount*100/$total_cost,3) AS percentage_cost
                    from batch_details b inner join raw_materials r
                    on b.rm_code = r.rm_code
                    where b.batch_id = ? "
            , [$batch[0]->id]);


        $pdf = PDF::loadView('Reports.mixing_paper_cost',array('batch' => $batch ,'bds' => $bds , 'total_cost' => $total_cost ,
            'total_qty' => $total_qty , 'recipe' => $recipe , 'date' => $date));
        return $pdf->download('mixing_ppr_w_cost_'.$date.'.pdf');
        // return view('Reports.mixing_paper_cost',compact('batch' , 'bds' , 'total_cost' , 'total_qty' , 'recipe' , 'date'));




    }
}
