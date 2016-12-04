<?php

namespace App\Http\Controllers;

use App\Batch;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class Test extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $batch  = Batch::find($id);
       $tests = \DB::table('batch_test')
           ->join('tests' , 'batch_test.test_id' , '=' , 'tests.id')
           ->where('batch_test.batch_id' , '=' , $id)
           ->select('batch_test.id' , 'tests.name' , 'tests.standard' , 'batch_test.qty AS value')
           ->get();
        return view('Batch.LabTest.home' , compact('batch', 'tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($id)
    {
        //

        $batch  = Batch::find($id);
        $tests = \App\Test::all();

        return view('Batch.LabTest.add_test' , compact('tests' ,'batch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,Request $request)
    {
        //
//        dd($request);
        $this->validate($request,[
            'value'=>'required',
        ]);

//        $test = \DB::table('tests')->where('id' , '=' , $request->test)->get();
        $today = Carbon::now()->toDateString();

        \DB::table('batch_test')->insert(
            ['qty' => $request->value,
                'test_id' => $request->test,
                'batch_id' => $id,
                'date' => $today
            ]
        );

        return redirect('/production/batch/'.$id.'/tests');

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
    public function edit($id1 , $id2)
    {
      $batch = \DB::table('batches')->where('id' , '=' , $id1)->get()->toArray();

        $test =  \DB::table('batch_test')
            ->join('tests' , 'batch_test.test_id' , '=' , 'tests.id')
            ->where('batch_test.batch_id' , '=' , $id1)
            ->where('batch_test.id' , '=' , $id2)
            ->get()
        ->toArray();

    return view('Batch.LabTest.update_test' , compact('test' ,'batch'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id1, $id2)
    {
        //
        $this->validate($request,[
            'value'=>'required',
        ]);

        \DB::table('batch_test')
            ->where('batch_id' , '=' , $id1)
            ->where('test_id' , '=' , $id2)
            ->update(['qty' => $request->value]);

       return redirect('/production/batch/'.$id1.'/tests');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id1 , $id2)
    {


        \DB::table('batch_test')
            ->where('id' , '=' , $id2)
            ->delete();

        return redirect('/production/batch/'.$id1.'/tests');
    }
}
