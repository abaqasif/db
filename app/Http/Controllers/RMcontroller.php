<?php
namespace App\Http\Controllers;
use App\Raw_Material;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Recipe;
class RMcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    //    $this->middleware('productionAdmin');
        $this->middleware('page_access');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($id){
//        $recipe = Recipe::find($id1);
//        $rms = \DB::select('select * from raw__materials');
//        return view('Recipe.add_rm_recipe' , compact('recipe','rms'));
    }
    public function index($id)
    {
        //
        $rms= \DB::table('raw_materials')
            ->join('recipe_rm','raw_materials.rm_code','=','recipe_rm.rm_code')
            ->select('raw_materials.*','recipe_rm.recipe_id','recipe_rm.qty','recipe_rm.rm_code')
            ->where('recipe_rm.recipe_id','=',$id)
            ->get();
        $recipe = Recipe::find($id);
        return view('Recipe.rm_update' , compact('rms','recipe'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $raws= \DB::table('raw_materials')
            ->join('recipe_rm','raw_materials.rm_code','=','recipe_rm.rm_code')
            ->select('raw_materials.*','recipe_rm.recipe_id','recipe_rm.qty','recipe_rm.rm_code')
            ->where('recipe_rm.recipe_id','=',$id)
            ->get();
        $rec= Recipe::find($id);
        $rms = \DB::select('select * from raw_materials');
        return view('Recipe.add_rm_update'  , compact('raws','rec','rms'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_rm($id){
        $raws= \DB::table('raw_materials')
            ->join('recipe_rm','raw_materials.rm_code','=','recipe_rm.rm_code')
            ->select('raw_materials.*','recipe_rm.recipe_id','recipe_rm.qty','recipe_rm.rm_code')
            ->where('recipe_rm.recipe_id','=',$id)
            ->get();

        $rec= Recipe::find($id);
        $rms = \DB::select('select * from raw_materials');
      return view('Recipe.add_rm_recipe' , compact('raws','rec','rms'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'qty' => 'required|numeric|between:0,99999999999999.99',
            'rm_code' => 'required|exists:raw_materials,rm_code|max:255',
        ]);
        \DB::table('recipe_rm')->insert(
            ['qty' => $request->qty, 'rm_code' => $request->rm_code,
                'recipe_id' => $id]);


        return redirect('/production/recipe/'.$id.'/add_rm');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id2)
    {
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id1 , $id2)
    {


        $req= \DB::table('recipe_rm')->where('recipe_id', '=',$id1)->where('rm_code', '=', $id2)->get();

    return view('Recipe.rm_update_form',compact('req' , 'id1' , 'id2'));

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id1 , $id2)
    {
        //
        $this->validate($request, [
            'qty' => 'required|numeric|between:0,99999999999999.99',
        ]);

        \DB::table('recipe_rm')
            ->where('recipe_id', '=',$id1)->where('rm_code', '=', $id2)
            ->update([ 'qty' => $request->qty ]);

       // return redirect(url('/production/recipe/'.$id1.'/add_rm'));
return redirect(url('/production/recipe/'.$id1.'/rm'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id1,$id2)
    {
        $access = \DB::table('recipe_rm')->where('recipe_id', '=',$id1)->where('rm_code', '=', $id2)->exists();
        if($access) {
            \DB::table('recipe_rm')->where('recipe_id', '=',$id1)->where('rm_code', '=', $id2)->delete();
        }
        return redirect('/production/recipe/'.$id1.'/add_rm');
    }
}