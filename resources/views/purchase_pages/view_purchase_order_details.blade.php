@extends('layouts.master_layout')
@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="x_panel">
                <div class="panel-heading"><h3>PURCHASE ORDER DETAILS</h3></div>
                <div class="panel-body">


                <div id ="warn" class="alert alert-danger alert-dismissible fade in" role="alert" style="visibility:hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>PURCHASE RECEIPT EXISTS FOR THIS PURCHASE ORDER!</strong> 
                  </div>

   <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="120%">
                     


<thead>
<tr>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="ID: activate to sort column descending"
   aria-sort="ascending">ID</th>




  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="RM: activate to sort column descending"
   aria-sort="ascending">RAW MATERIAL</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="QTY: activate to sort column descending"
   aria-sort="ascending">QUANTITY</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="RATE: activate to sort column descending"
   aria-sort="ascending">RATE</th>




  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="TAX RATE: activate to sort column descending"
   aria-sort="ascending">TAX RATE</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="TAX AMOUNT: activate to sort column descending"
   aria-sort="ascending">TAX AMOUNT</th>





  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="TOTAL: activate to sort column descending"
   aria-sort="ascending">TOTAL</th>



<th></th>
</tr>






 </thead>


 
 <tbody>
    @foreach($output as $pos) 
    <tr>
  <td>{{$pos->id}}</td>
  <td>{{$pos->rm_name}}</td>
  <td>{{$pos->qty}}</td>
  <td>{{$pos->rate}}</td>
  <td>{{$pos->tax_rate}}</td>
  <td>{{$pos->tax_amount}}</td>
  <td>{{$pos->total}}</td>
  <td>
  <button type="button" class="btn btn-success"  onclick="edit({{$pos->id}})">EDIT</button>
  <a href="{{url('/delete_purchase_order_details/'.$pos->id)}}" type="button" class="btn btn-danger">DELETE</a>
  

</td>
</tr>
  </tr>
  @endforeach
    </tbody>
</table>





 
                     







                </div>
                 </div>
                 </div>
                 </div>
                 </div>


  

               



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="x_panel">
                <div class="panel-heading"><h3>PURCHASE RECEIPTS</h3></div>
                <div class="panel-body">

   <table id="datatable-responsive-two" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="120%">
                     


<thead>
<tr>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="ID: activate to sort column descending"
   aria-sort="ascending">ID</th>




  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="RM: activate to sort column descending"
   aria-sort="ascending">RAW MATERIAL</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="QTY: activate to sort column descending"
   aria-sort="ascending">QUANTITY ORDERED</th>

  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="QTY REC: activate to sort column descending"
   aria-sort="ascending">QUANTITY RECEIVED</th>

  

<th>RECEIPT QUANTITY</th>
</tr>






 </thead>


 
 <tbody>
    @foreach($output as $pos) 

    <tr>
  <td>{{$pos->id}}</td>
  <td>{{$pos->rm_name}}</td>
  <td>{{$pos->qty}}</td>
  <td>{{$pos->p_qty}}</td>
  <td>
 <input id="quantity" type="number">

</td>
</tr>
  </tr>
  @endforeach
    </tbody>
</table>

<button id="submit" type="button" class="btn btn-success" onclick="purchase_receipt()">SUBMIT</button>


 
                     







                </div>
                 </div>
                 </div>
                 </div>
                 </div>



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="x_panel">
                <div class="panel-heading"><h3>PURCHASE RETURNS</h3></div>
                <div class="panel-body">

   <table id="datatable-responsive-three" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="120%">
                     


<thead>
<tr>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="ID: activate to sort column descending"
   aria-sort="ascending">ID</th>




  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="RM: activate to sort column descending"
   aria-sort="ascending">RAW MATERIAL</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="QTY: activate to sort column descending"
   aria-sort="ascending">QUANTITY ORDERED</th>

  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="QTY REC: activate to sort column descending"
   aria-sort="ascending">QUANTITY RECIEVED</th>

<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="REC ID: activate to sort column descending"
   aria-sort="ascending">RECEIPT ID</th>  

<th>RETURN QUANTITY</th>
</tr>






 </thead>


 
 <tbody>
    @foreach($output as $pos) 

    <tr>
  <td>{{$pos->id}}</td>
  <td>{{$pos->rm_name}}</td>
  <td>{{$pos->qty}}</td>
  <td>{{$pos->p_qty}}</td>
  <td>{{$pos->r_id}}</td>
  <td>
 <input id="quantity" type="number">

</td>
</tr>
  </tr>
  @endforeach
    </tbody>
</table>

<button id="submit2" type="button" class="btn btn-danger" onclick="purchase_return()">SUBMIT</button>


 
                     







                </div>
                 </div>
                 </div>
                 </div>
                 </div>


   <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="myModal">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">EDIT PURCHASE ORDER DETAILS</h4>
                        </div>
                        <div class="modal-body">
                          <BR>
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"><label for="QTY" class="col-md-4 control-label">QUANTITY</label>
                         <div class="col-md-6"><input id="QTY" value="{{old ('name')}}" style="text-transform:uppercase" type="text" class="form-control" name="QTY" ></div>
                         </div>
                         <BR>
                          
                        <div class="form-group{{ $errors->has('pack_size') ? ' has-error' : '' }}"><label for="TAX_RATE" class="col-md-4 control-label">TAX RATE</label>
                        <div class="col-md-6"><input id="TAX_RATE" type="NUMBER" value="{{old ('pack_size')}}" class="form-control" name="TAX_RATE"></div>
                        </div>
                       
                          <BR>
                            <BR>
                              <BR>
                                <BR>
                              <BR>
                         <CENTER> <button type="button" class="btn btn-primary" onclick="save()">Save </button></CENTER>
                        

                      </div>
                    </div>
                  </div>
                </div>



     <script src="{{asset('assets/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-scroller/js/datatables.scroller.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('assets/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/vendors/pdfmake/build/vfs_fonts.js')}}"></script>

    
      


      

 <script>
     


    $('#datatable-responsive').DataTable();

    $('#datatable-responsive-two').DataTable();

    $('#datatable-responsive-three').DataTable();

    var pod;

function save(){


var tax_rate=document.getElementById('TAX_RATE').value;
var qty=document.getElementById('QTY').value;
//alert(pod);

 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 $.ajax({

  type: 'POST', 
  url: '{{URL::to('edit_purchase_order_det')}}' ,
  data: {

    'POD_ID' : pod,
    'tax_rate' :tax_rate ,
    'qty' :qty ,
    
  } ,

   
  


  success:function(data)

  {
    
     console.log(data);
      $('#myModal').modal('hide');
    
    if(data.localeCompare("fail")==0){
    document.getElementById('warn').style.visibility="visible"; }

     if(data.localeCompare("success")==0){
    location.reload(); }
    
    
   
   

 }});


}


function edit(pod_id){

pod=pod_id;

   $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 $.ajax({

  type: 'GET', 
  url: '{{URL::to('purchase_order_det_edit')}}' ,
  data: {
    
    'POD_ID' : pod_id,
    
  } ,

   
  


  success:function(data)

  {
    
     console.log(data);
     $('#TAX_RATE').val(data[0].tax_rate);
     $('#QTY').val(data[0].qty);


     $('#myModal').modal('show');
    
   
   

 }});




}


function purchase_receipt(){

var table = document.getElementById("datatable-responsive-two");
var r = document.getElementById("datatable-responsive-two").rows.length;
// alert(r);

var POD_ID;
var QTY;

 for(var temp=1; temp<r ;temp++){

  POD_ID=table.rows[temp].cells[0].innerHTML;
  QTY=table.rows[temp].cells[4].children[0].value;

  //alert(POD_ID);
  //alert(QTY);

if(QTY!==null){

  $.ajax({

  type: 'GET', 
  url: '{{URL::to('create_purchase_receipt')}}' ,
  data: {
    
    'POD_ID' : POD_ID,
    'QTY' : QTY ,
  } ,

   
  


  success:function(data)

  {
    if(data.no!=="")
    { 
     console.log(data);
     location.reload();
    
   }
   

 }});







}





 }


}




function purchase_return(){

var table = document.getElementById("datatable-responsive-three");
var r = document.getElementById("datatable-responsive-two").rows.length;
// alert(r);

var POD_ID;
var QTY;
var REC_ID;

 for(var temp=1; temp<r ;temp++){

  POD_ID=table.rows[temp].cells[0].innerHTML;
  QTY=table.rows[temp].cells[5].children[0].value;
  REC_ID=table.rows[temp].cells[4].innerHTML;

  

if(QTY!==null){

  $.ajax({

  type: 'GET', 
  url: '{{URL::to('create_purchase_return')}}' ,
  data: {
    
    'POD_ID' : POD_ID,
    'QTY' : QTY ,
    'REC_ID' : REC_ID,
  } ,

   
  


  success:function(data)

  {
    if(data.no!=="")
    { 
     console.log(data);
     location.reload();
    
   }
   

 }});







}





 }



}
</script>

@endsection