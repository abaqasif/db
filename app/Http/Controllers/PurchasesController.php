<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\raw_materials;
use App\Http\Requests;
use App\suppliers;
use App\purchase_orders;
use App\purchase_receipt;
use App\purchase_order_line;
use App\purchase_return;
use App\payments;

use Validator;
use PDF;

class PurchasesController extends Controller
{
public function __construct()
    {
    	$this->middleware('auth');
       $this->middleware('page_access');
     
    	
        
    }



public function create_raw_materials_form(){

    $allsuppliers=suppliers::all();
	return view('purchase_pages.create_raw_materials', compact('allsuppliers'));
}




public function create_suppliers_form(){

	return view('purchase_pages.create_suppliers');
}






   public function create_raw_materials(Request $Request){


    $this->validate($Request,[
    'name'=>'required|unique:raw_materials',
    'uom'=>'required',
    'supp_id'=>'required',
    'rate'=>'required',
   


    ]);



$id=\DB::select('select COALESCE(max(id)+1,0) as id from raw_materials ');
$rm_code='R-'.$id[0]->id;

 
           $rm = new raw_materials;

 
           $rm->name = strtoupper($Request['name']); 
           $rm->uom= $Request['uom'];
           if($Request->op_inv)
           {$rm->op_inv = $Request['op_inv'];
           $rm->qty_available = $Request['op_inv']; }
          if($Request->pack_size)
          {$rm->pack_size=$Request['pack_size'];}
          if($Request->type)
          {$rm->type=strtoupper($Request['type']);}
          $rm->supp_id = $Request[ 'supp_id'];
          $rm->rate=$Request['rate'];
          $rm->rm_code=$rm_code;
          

          $rm->save();            

    	  return redirect('/show_raw_materials');


        return $rm_code;
    }




    public function edit_raw_material_form(){
      $rms=raw_materials::all();
      $allsuppliers=suppliers::all();
    
   return view('purchase_pages.edit_raw_materials',compact('rms','allsuppliers'));


    }

      public function edit_raw_material(Request $Request){

  $output=$Request->rm_id;

 
          

\DB::table('raw_materials')->where('id','=',$Request->rm_id)->update([
  
  'name' => strtoupper($Request->name), 
  'op_inv'=>$Request->op_inv,
  'pack_size'=>$Request->pack_size,
  'type'=>$Request->type,
  'rate'=>$Request->rate
  
  
  ]);
        
        return Response($output);
  }
    





   public function create_suppliers(Request $Request){
   



   	 $this->validate($Request,[
    'name'=>'required|unique:suppliers',
    'address'=>'required',
    'payment_term'=>'required',
    'owner_number'=>'regex:/03[0-4][0-9]{8}/',
    'mobile_number'=>'regex:/03[0-4][0-9]{8}/',
    'phone_number'=>'regex:/0213[2-9][0-9]{6}/',
    'web_add'=>'regex:/www.([a-z])*@([a-z])/',
   


    ]);





   

           $sup = new suppliers;

 
           $sup->name = strtoupper($Request['name']); 
           $sup->address= strtoupper($Request['address']);
           $sup->owner_name = strtoupper($Request['owner_name']);
           $sup->email = strtolower($Request['email']); 
           $sup->payment_term = $Request[ 'payment_term'];
           if($Request->credit_limit)
          { $sup->credit_limit = $Request[ 'credit_limit'];}
           $sup->owner_number = $Request['owner_number']; 
           $sup->phone_number= $Request['phone_number'];
           $sup->mobile_number = $Request['mobile_number'];
           $sup->contact_person = $Request['contact_person'];
           if($Request->web_add) 
          { $supp->web_add=strtolower($Request['web_add']);}

         
          $sup->save(); 


          return redirect('/show_suppliers');       




   }

   public function show_raw_materials(){
   $rms=raw_materials::all();

    $allsuppliers=suppliers::all();
    return view('purchase_pages.show_raw_materials',compact('rms','allsuppliers'));}




  public function show_suppliers(){
   $sups=suppliers::all();


    return view('purchase_pages.show_suppliers',compact('sups'));}





public function delete_suppliers(Request $Request){

  if($Request->ajax()){
  $id=$Request->supp_id;
  $output=$id;

  $rm=\DB::select("select * from raw_materials where supp_id=".$id);
 
 if($rm==null){

  $supplier=suppliers::where('id','=',$id);
  $supplier->delete();
  return Response("success");

}
else
  {return Response("fail");}


 /* return Response($output);*/


  }
}

public function edit_supplier_form($id){


return view('purchase_pages.edit_supplier'); }

public function edit_supplier(Request $Request){

            
           $sup = suppliers::where('id','=',$Request->supp_id)->update([

 
           'name' => strtoupper($Request['name']), 
           'address' =>strtoupper($Request['address']),
           'owner_name' => strtoupper($Request['owner_name']),
           'email' => strtolower($Request['email']), 
            'payment_term' => $Request[ 'payment_term'],
           
           'credit_limit' => $Request[ 'credit_limit'],
            'owner_number' => $Request['owner_number'], 
             'phone_number'=> $Request['phone_number'],
           'mobile_number' => $Request['mobile_number'],
           'contact_person' => $Request['contact_person'], 
             'web_add'=>strtolower($Request['web_add'])

         
          ]);

          return redirect("show_suppliers");




}

public function delete_raw_materials(Request $Request){
if($Request->ajax()){
$output=$Request->rm_id;
raw_materials::where('id','=',$Request->rm_id)->delete();

return Response($output);
}
}

public function show_test(){



$bg=\DB::select('select sum(purchase_orders.total) as data from purchase_orders
join suppliers where purchase_orders.supp_id=suppliers.id
 group by purchase_orders.supp_id');

$supp=\DB::select('select name from suppliers');


 

  return view('purchase_pages.test',compact('bg','supp'));}





public function rm_det(Request $Request){
if($Request->ajax())
{

$rm=raw_materials::where('id','=',$Request->rm_id)->first();
$output=array([
'rm_id'=>$rm->id,
'name'=>$rm->name,
'type'=>$rm->type,
'uom'=>$rm->uom,
'rate'=>$rm->rate,
'op_inv'=>$rm->op_inv,
'pack_size'=>$rm->pack_size,
'supp_id'=>$rm->supp_id

]);

return Response($output);

}
}




public function rm_name_det(Request $Request){
if($Request->ajax())
{

$rm=raw_materials::where('id','=',$Request->name)->first();
$output=array([
'rm_id'=>$rm->id,
'name'=>$rm->name,
'type'=>$rm->type,
'uom'=>$rm->uom,
'rate'=>$rm->rate,
'op_inv'=>$rm->op_inv,
'pack_size'=>$rm->pack_size,
'supp_id'=>$rm->supp_id

]);

return Response($output);

}
}



public function supp_det(Request $Request){
if($Request->ajax())
{

$supp=suppliers::where('id','=',$Request->supp_id)->first();
$output=array([
'supp_id'=>$supp->id,
'name'=>$supp->name,
'address'=>$supp->address,
'owner_name'=>$supp->owner_name,
'owner_number'=>$supp->owner_number,
'credit_limit'=>$supp->credit_limit,
'payment_term'=>$supp->payment_term,
'contact_person'=>$supp->contact_person,
'mobile_number'=>$supp->mobile_number,
'phone_number'=>$supp->phone_number


]);

return Response($output);

}
}






public function create_purchases_form(){
 $supps=\DB::table('suppliers')->get();
 $allPONs=\DB::table('purchase_orders')->pluck('id')->all();
 $date=\Carbon\Carbon::now('Asia/Karachi')->toDateString();
return view('purchase_pages.create_purchases',compact('supps', 'allPONs','date'));


}


public function rm_rate(Request $Request){

if($Request->ajax()){

$rate="";
$output="";





$output=\DB::table('raw_materials')
->where('supp_id', '=', $Request['supp_id'])
->where('name','=',$Request['name'])
->pluck('rate');
//console.log($rate);
if($output){

//$output=$rate;

//return $output;                         
return Response($output);


}

else{ 
return Response()->json(['no'=>'Not Found']);
}
}




}






public function supplier_rm(Request $Request){
if($Request->ajax()){

$names="";
$output="";





$names=\DB::table('raw_materials')
->where('supp_id', '=', $Request['supplier_id'])
->get();

if($names){
                                 
foreach($names as $key=>$name){
$output.='<option value='. $name->id. '>'. $name->name . '</option>'; }
 // $output=$names;
return Response($output);


}

else{ 
return Response()->json(['no'=>'Not Found']);
}
}





}


public function create_purchase_order(Request $Request){

$output="";

if($Request->ajax()){
$supp=$Request->supplier_id;
$total=$Request->total;
$date=$Request->date;
$remarks=$Request->remarks;

$PO= new purchase_orders;

if($remarks){$PO->remarks=$remarks;}

$PO->date=$date;
$PO->supp_id=$supp; 
$PO->total=$total; 


$PO->save();



$output=$PO->id;
return Response($output);

}




}

public function create_purchase_order_line(Request $Request){

if($Request->ajax()){
$id=$Request->purchase_id;
$rm_id= $Request->rm_id;
$qty=$Request->qty;
$rate=$Request->rate;
$tax=$Request->tax;
$tax_amt=$Request->tax_amount;
$total=$Request->total;


$POL=new purchase_order_line;

$POL->purchase_orders_id=$id;
$POL->rm_id=$rm_id;
$POL->qty=$qty;
$POL->rate=$rate;
$POL->tax_rate=$tax;
$POL->tax_amount=$tax_amt;
$POL->total=$total;

$POL->save();



$output=$id;


return Response($output);





}

}




public function printInvoice($id){

//$output="success";
//$pod=$Request['purchase_order_id'];


$pur_order=purchase_orders::where('purchase_orders.id',$id)
-> join('suppliers','purchase_orders.supp_id','=','suppliers.id')
->select('suppliers.name as supp_name','purchase_orders.id as id',
  'purchase_orders.remarks as remarks','purchase_orders.total as total','purchase_orders.date as date')
->get();

$pur_order_line=purchase_order_line::where('purchase_orders_id',$id)
->join('raw_materials', 'purchase_order_lines.rm_id','=', 'raw_materials.id')
->select('purchase_order_lines.id as id','raw_materials.name as rm_name','purchase_order_lines.qty as qty',
'purchase_order_lines.rate as rate','purchase_order_lines.tax_rate as tax_rate','purchase_order_lines.total as total','purchase_order_lines.tax_amount as tax_amount')
->get();
$pdf = PDF::loadView('purchase_pages.pdf_purchase_order',compact('pur_order','pur_order_line'));
return $pdf->download('pdf_purchase_order.pdf');



/*$pdf = PDF::loadView('purchase_pages.create_purchases_form',null);
return $pdf->download('create_purchases_form.pdf');*/





}





public function payments($id){


$output=\DB::select('select sum(purchase_receipt.total) as tot, (sum(purchase_receipt.total)-sum(payments.total)) as outstanding, 
  suppliers.name as supp_name,suppliers.id as supp_id ,purchase_receipt.id as id
  from purchase_receipt
  left join payments on purchase_receipt.id=payments.purchase_receipt_id 
  join purchase_orders on purchase_receipt.purchase_orders_id=purchase_orders.id 
  join suppliers on purchase_orders.supp_id=suppliers.id where purchase_receipt.id='.$id.';');

  return view('purchase_pages.payments',compact('output'));
}


public function show_purchases(){

  $purchase_order=purchase_orders::all();

  return view('purchase_pages.view_purchase_order',compact('purchase_order'));
}




public function show_purchase_order_details($id){

/*$receipt=purchase_receipt::where('purchase_orders_details_id',$id)->get();
$output=purchase_order_line::where('purchase_orders_id',$id)->union($receipt)->get();*/
$output=\DB::table('purchase_order_lines')->where('purchase_order_lines.purchase_orders_id','=',$id)->
leftJoin('purchase_receipt', 'purchase_order_lines.id','=','purchase_receipt.purchase_orders_details_id')->
join('raw_materials','raw_materials.id','=','purchase_order_lines.rm_id') 
->select('purchase_order_lines.id','purchase_order_lines.rm_id','purchase_order_lines.qty',
  'purchase_order_lines.rate','purchase_order_lines.tax_rate','purchase_order_lines.tax_amount',
  'purchase_order_lines.total','purchase_receipt.p_qty','purchase_receipt.id as r_id','raw_materials.name as rm_name')
->get();



return view('purchase_pages.view_purchase_order_details',compact('output'));
}




public function delete_purchase_order_details($id){


\DB::statement('call DeletePurchaseOrderDetails('.$id.',@p1,@p2,@p3,@p4)');


     $purchase_order=purchase_orders::all();
    // return view('purchase_pages.view_purchase_order',compact('purchase_order'));
     
    // $this->show_purchases();
   return redirect()->action('PurchasesController@show_purchases');



}



public function delete_purchase_order($id){

  purchase_order_line::where('purchase_orders_id',$id)->delete();
  purchase_orders::where('id',$id)->delete();


         $purchase_order=purchase_orders::all();
     
 
   //  $this->show_purchases();
 return redirect()->action('PurchasesController@show_purchases');
}




public function create_purchase_receipt(Request $Request){
$v1=$Request->POD_ID;
$v2=$Request->QTY;


$output="";
\DB::statement('CALL `CreatePurchaseReceipts`('.$v1.', @p1, @p2, @p3,' .$v2.', 
@p5, @p6, @p7, @p8, @p9, @p10, @p11, @p12, @p13)');
return Response("purchase receipt successfully created");

}




public function create_purchase_return(Request $Request){
$v1=$Request->POD_ID;
$v2=$Request->QTY;
$v3=$Request->REC_ID;


\DB::statement('CALL `CreatePurchaseReturns`('.$v3.',' .$v2.', @p2, @p3, @p4, @p5, @p6,' .$v1.', @p8, @p9, @p10, @p11, @p12, @p13, @p14, @p15, @p16, @p17, @p18, @p19)');
return Response("purchase return successful");

}



public function purchase_order_dreport($date){


$pur_order=purchase_orders::where('date',$date)->get();

$pdf = PDF::loadView('purchase_pages.pdf_purchase_order_date',compact('pur_order'));
return $pdf->download('pdf_purchase_order_date.pdf');



}



public function purchase_order_greport(){


$pur_order=\DB::select('select sum(purchase_orders.total) as tot, purchase_orders.supp_id, suppliers.name as supp_name from purchase_orders
join suppliers where purchase_orders.supp_id=suppliers.id
 group by supp_id');

$pdf = PDF::loadView('purchase_pages.pdf_purchase_order_group',compact('pur_order'));
return $pdf->download('pdf_purchase_order_group.pdf');



}



public function view_purchase_receipt(){

$output=\DB::table('purchase_receipt')
-> join('purchase_order_lines','purchase_receipt.purchase_orders_details_id','=',
 'purchase_order_lines.id' )
-> join('raw_materials','purchase_order_lines.rm_id','=','raw_materials.id')
->select('purchase_receipt.id as id','purchase_receipt.purchase_orders_id as purchase_orders_id',
  'purchase_receipt.purchase_orders_details_id as purchase_orders_details_id',
'purchase_receipt.p_qty as p_qty','purchase_receipt.total as total','purchase_receipt.pdate as pdate',
  'raw_materials.name as rm_name','raw_materials.id as rm_id')
->get();



return view('purchase_pages.view_purchase_receipt',compact('output'));


}




public function invoice_purchase_receipt($id){

$output=\DB::table('purchase_receipt')->where('purchase_receipt.id',$id)
-> join('purchase_order_lines','purchase_receipt.purchase_orders_details_id','=',
 'purchase_order_lines.id' )
-> join('raw_materials','purchase_order_lines.rm_id','=','raw_materials.id')
->select('purchase_receipt.id as id','purchase_receipt.purchase_orders_id as purchase_orders_id',
  'purchase_receipt.purchase_orders_details_id as purchase_orders_details_id',
'purchase_receipt.p_qty as p_qty','purchase_receipt.total as total','purchase_receipt.pdate as pdate',
  'raw_materials.name as rm_name')
->get();

$pdf = PDF::loadView('purchase_pages.pdf_purchase_receipt',compact('output'));
return $pdf->download('pdf_purchase_receipt.pdf');

}




public function purchase_receipt_dreport($date){

$output=\DB::table('purchase_receipt')
-> join('purchase_order_lines','purchase_receipt.purchase_orders_details_id','=',
 'purchase_order_lines.id' )
-> join('raw_materials','purchase_order_lines.rm_id','=','raw_materials.id')
->where('purchase_receipt.pdate','=',$date)
->select('purchase_receipt.id as id','purchase_receipt.purchase_orders_id as purchase_orders_id',
  'purchase_receipt.purchase_orders_details_id as purchase_orders_details_id',
'purchase_receipt.p_qty as p_qty','purchase_receipt.total as total','purchase_receipt.pdate as pdate',
  'raw_materials.name as rm_name')
->get();


$dd=$date;
$pdf = PDF::loadView('purchase_pages.pdf_purchase_receipt_dreport',compact('output','dd'));
return $pdf->download('pdf_purchase_receipt_dreport.pdf');

}




public function invoice_group_purchase_receipt($id){

$output=\DB::table('purchase_receipt')
-> join('purchase_order_lines','purchase_receipt.purchase_orders_details_id','=',
 'purchase_order_lines.id' )
-> join('raw_materials','purchase_order_lines.rm_id','=','raw_materials.id')
->where('purchase_order_lines.purchase_orders_id','=',$id)
->select('purchase_receipt.id as id','purchase_receipt.purchase_orders_id as po_id',
  'purchase_receipt.purchase_orders_details_id as purchase_orders_details_id',
'purchase_receipt.p_qty as p_qty','purchase_receipt.total as total','purchase_receipt.pdate as pdate',
  'raw_materials.name as rm_name')
->get();

$p_id=$id;

$pdf = PDF::loadView('purchase_pages.pdf_purchase_receipt_group',compact('output','p_id'));
return $pdf->download('pdf_purchase_receipt_group.pdf');





}




public function view_purchase_return(){

$output=\DB::table('purchase_return')
-> join('purchase_receipt','purchase_receipt.id','=', 'purchase_return.purchase_receipt_id')
-> join('purchase_order_lines','purchase_receipt.purchase_orders_details_id','=',
 'purchase_order_lines.id' )
-> join('raw_materials','purchase_order_lines.rm_id','=','raw_materials.id')
->select('purchase_receipt.id as r_id', 'purchase_return.id as id',
'purchase_return.qty as p_qty','purchase_return.total as total','purchase_return.rdate as pdate',
  'raw_materials.name as rm_name')
->get();

return view('purchase_pages.view_purchase_return',compact('output'));


}


public function invoice_purchase_return($id){
$output=\DB::table('purchase_return')
-> join('purchase_receipt','purchase_receipt.id','=', 'purchase_return.purchase_receipt_id')
-> join('purchase_order_lines','purchase_receipt.purchase_orders_details_id','=',
 'purchase_order_lines.id' )
-> join('raw_materials','purchase_order_lines.rm_id','=','raw_materials.id')
->where('purchase_return.id',$id)
->select('purchase_receipt.id as id', 'purchase_return.id as purchase_return_id',
'purchase_return.qty as p_qty','purchase_return.total as total','purchase_return.rdate as pdate',
  'raw_materials.name as rm_name')
->get();


/*$output=purchase_return::where('id','=',$id)->select('purchase_return.id as purchase_return_id')->get();*/

$pdf = PDF::loadView('purchase_pages.pdf_purchase_return',compact('output'));
return $pdf->download('pdf_purchase_return.pdf');


/*
return view('purchase_pages.pdf_purchase_return',compact('output'));*/

/*return $output;*/
}


public function invoice_group_purchase_return($id){
$output=\DB::table('purchase_return')
-> join('purchase_receipt','purchase_receipt.id','=', 'purchase_return.purchase_receipt_id')
-> join('purchase_order_lines','purchase_receipt.purchase_orders_details_id','=',
 'purchase_order_lines.id' )
-> join('raw_materials','purchase_order_lines.rm_id','=','raw_materials.id')
->where('purchase_receipt.id','=' ,$id)
->select('purchase_receipt.id as id', 'purchase_return.id as purchase_return_id',
'purchase_return.qty as p_qty','purchase_return.total as total','purchase_return.rdate as pdate',
  'raw_materials.name as rm_name')
->get();


/*$output=purchase_return::where('id','=',$id)->select('purchase_return.id as purchase_return_id')->get();*/
$dd=$id;

$pdf = PDF::loadView('purchase_pages.pdf_purchase_return_group',compact('output','dd'));
return $pdf->download('pdf_purchase_return_group.pdf');


/*
return view('purchase_pages.pdf_purchase_return',compact('output'));*/

/*return $output;*/
}


public function purchase_return_dreport($date){

$output=\DB::table('purchase_return')
-> join('purchase_receipt','purchase_receipt.id','=', 'purchase_return.purchase_receipt_id')
-> join('purchase_order_lines','purchase_receipt.purchase_orders_details_id','=',
 'purchase_order_lines.id' )
-> join('raw_materials','purchase_order_lines.rm_id','=','raw_materials.id')
->where('purchase_return.rdate','=' ,$date)
->select('purchase_receipt.id as id', 'purchase_return.id as purchase_return_id',
'purchase_return.qty as p_qty','purchase_return.total as total','purchase_return.rdate as pdate',
  'raw_materials.name as rm_name')
->get();

$dd=$date;

$pdf = PDF::loadView('purchase_pages.pdf_purchase_return_dreport',compact('output','dd'));
return $pdf->download('pdf_purchase_return_dreport.pdf');



}


public function delete_purchase_receipt($id){
$payments=payments::where('purchase_receipt_id','=',$id)->get();



\DB::statement('CALL `DeletePurchaseReceipt`('.$id.', @p1, @p2, @p3, @p4);');
return redirect('/view_purchase_receipt');


}



public function delete_purchase_return($id){



\DB::statement('CALL `DeleteReturns`('.$id. ', @p1, @p2, @p3, @p4, @p5, @p6, @p7, @p8, @p9, @p10, @p11, @p12, @p13);'); 
return redirect('/view_purchase_return');

}



public function post_create_payments(Request $Request ){
  
  $pay=new payments;
  $pay->supp_id=$Request['supp_id'];
  $pay->purchase_receipt_id=$Request['pr_id'];
  $pay->cheque_no=$Request['check_no'];
  $pay->remarks=strtoupper($Request['remarks']);
  $pay->date=$Request['date'];
  $pay->total=$Request['total'];
  $pay->save();

$output="payment successful";
/*return redirect('/view_purchase_receipt');*/
  
return Response($output);

}


public function purchase_order_det_edit(Request $Request){
$out=purchase_order_line::where('id','=',$Request->POD_ID)->first();

$output=array([
  'tax_rate' => $out->tax_rate,
  'qty'=> $out->qty

  ]);

return $output;
/*return Response($output);*/

}


public function edit_purchase_order_det(Request $Request){

$out=\DB::table('purchase_order_lines')->where('id','=',$Request->POD_ID)->first();
$rec=\DB::table('purchase_receipt')->where('purchase_orders_id','=',$out->purchase_orders_id)->first();

$po=purchase_orders::where('id','=' ,$out->purchase_orders_id)->first();

$old_t_po=$po->total;
$old_t_pod=$out->total;
$new_t_po=$old_t_po-$old_t_pod;




if($rec==null)
{ 

$r_rate=$out->rate;
$r_qty=$Request->qty;
$r_tax_rate=$Request->tax_rate;
$r_total=$r_qty * $r_rate;
$r_tax_amount=$r_total * $r_tax_rate;
$r_tt=$r_tax_amount/100;
$r_grand_total=$r_total+$r_tt;


$f_t_po=$new_t_po + $r_grand_total;

$po->update(['total'=>$f_t_po]);


\DB::select('update purchase_order_lines set tax_rate='.$Request->tax_rate.",
 qty=".$Request->qty.",tax_amount=".$r_tt.", total=".$r_grand_total." where id=".$Request->POD_ID.";");

return Response("success");
}

return Response("fail");



}




public function outstanding_payments_report(){


$output=\DB::select('select sum(purchase_receipt.total) as tot, 
  IFNULL((sum(purchase_receipt.total)-sum(payments.total)),sum(purchase_receipt.total)) as outstanding, 
  suppliers.name as supp_name from suppliers 
  left join purchase_orders on suppliers.id=purchase_orders.supp_id join purchase_receipt
   on purchase_orders.id=purchase_receipt.purchase_orders_id left 
  join payments on purchase_receipt.id=payments.purchase_receipt_id group by supp_name;' );



$pdf = PDF::loadView('purchase_pages.pdf_outstanding_payments_summary',compact('output'));
return $pdf->download('pdf_outstanding_payments_summary.pdf');


}


public function view_purchase_payments(){



$output=\DB::select('select suppliers.name as supp_name, payments.id as id, purchase_receipt_id as pr_id, cheque_no as ch_no, remarks as remarks,
  total as  total, date as date from payments join suppliers on payments.supp_id=suppliers.id');

return view ('purchase_pages.view_purchase_payments',compact('output'));

}



public function delete_purchase_payments($id){

payments::where('id',$id)->delete();
return redirect('/view_purchase_payments');

}



public function purchase_payments_det(Request $Request){
$pd=\DB::table('payments')->where('id',$Request->id)->first();
$output=array([
  'id' => $pd->id,
  'supp_id'=>$pd->supp_id,
  'pr_id'=>$pd->purchase_receipt_id,
  'cheque_no'=>$pd->cheque_no,
  'remarks'=>$pd->remarks,
  'total'=>$pd->total,
  'date'=>$pd ->date
]);



return Response($output);

}


public function update_purchase_payments(Request $Request){
  \DB::select('update payments set cheque_no='.$Request->cheque_no.',remarks='."UPPER( ' ".$Request->remarks." ') ,
    total= " .$Request->total. ', date ='. " ' " .$Request->date ." ' where id=".$Request->id);

  $output="payment successfully updated";

  return Response($output);


}








public function raw_materials_ledger_report($id){


$op_inv=\DB::SELECT('select op_inv as op_inv ,name  as name from raw_materials where id='.$id);
$pur=\DB::select('select @s_no:=@s_no+1 as rank, sum(purchase_receipt.total) as 
  total,purchase_receipt.pdate as date from purchase_receipt join purchase_order_lines
   on purchase_receipt.purchase_orders_details_id=purchase_order_lines.id join raw_materials on
    purchase_order_lines.rm_id= raw_materials.id where raw_materials.id='.$id.'
  GROUP by purchase_receipt.pdate order by rank');





$pdf = PDF::loadView('purchase_pages.pdf_raw_materials_ledger_report',compact('pur','op_inv'));
return $pdf->download('pdf_raw_materials_ledger_report.pdf');





}


public function payment_voucher($id){
$output=\DB::select('select suppliers.name as supp_name, payments.id as id, purchase_receipt_id as pr_id, cheque_no as ch_no, remarks as remarks,
  total as  total, date as date from payments join suppliers on payments.supp_id=suppliers.id
  where payments.id='.$id);

$pdf = PDF::loadView('purchase_pages.pdf_payments_voucher',compact('output'));
return $pdf->download('pdf_payments_voucher.pdf');


}





public function list_of_suppliers(){
$supp=\DB::select('select suppliers.id as id, suppliers.name as name,
 suppliers.address as address,suppliers.payment_term as payment_term, purchase_orders.id as pod from suppliers 
 left join purchase_orders on suppliers.id=purchase_orders.supp_id ');

$pdf = PDF::loadView('purchase_pages.pdf_active_suppliers',compact('supp'));
return $pdf->download('pdf_active_suppliers.pdf');

}



public function payables_ledger($dateto,$datefrom){

$ledger=\DB::select("select sum(purchase_receipt.total) as total ,suppliers.name as name from purchase_receipt join purchase_orders on purchase_receipt.purchase_orders_id=purchase_orders.id join suppliers on purchase_orders.supp_id=suppliers.id where
 purchase_receipt.pdate between Date(".$datefrom.") AND Date(".$dateto.") group by suppliers.name " );



$pdf = PDF::loadView('purchase_pages.pdf_payables_ledger',compact('ledger'));
return $pdf->download('pdf_payables_ledger.pdf');


}



public function rm_ageing_report(){

$rm=raw_materials::all();  
$pdf = PDF::loadView('purchase_pages.pdf_raw_materials_ageing_report',compact('rm'));
return $pdf->download('pdf_raw_materials_ageing_report.pdf');


}









}




