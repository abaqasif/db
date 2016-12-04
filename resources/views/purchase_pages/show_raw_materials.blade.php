@extends('layouts.master_layout')
@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="x_panel">
                <div class="panel-heading"><h3>REPORTS</h3></div>
                <div class="panel-body">
<!-- 
                  <H4>ALL SPPLIERS</H4>
                  
                    <div class="col-md-6"><input id="datez"  type="date"  class="form-control" name="datez"></div>
                    <button class="btn btn-success" TYPE="BUTTON" onclick=>GENERATE</button>
                    <BR>
                      <BR>
                    
                    <H4>PURCHASE ORDER NUMBER FOR PURCHASE RECEIPTS</H4>

                    <div class="col-md-6"><input id="pod"  type="number"  class="form-control" name="pod"></div>
                    <button class="btn btn-success" TYPE="BUTTON" onclick="group_report()">GENERATE</button>

                   <BR>

                    <BR> -->
                    
                    <H4>RAW MATERIALS AGEING REPORT
                
                    <a href="{{url('/rm_ageing_report')}}" class="btn btn-success" TYPE="BUTTON" >GENERATE</a></H4>



</div>
</div>
</div>
</div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="x_panel">
                <div class="panel-heading"><h3>All Raw Materials</h3></div>
                <div class="panel-body">


   <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="120%">
                     


<thead>
<tr>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="ID: activate to sort column descending"
   aria-sort="ascending">ID</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="NAME: activate to sort column descending"
   aria-sort="ascending">NAME</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="TYPE: activate to sort column descending"
   aria-sort="ascending">TYPE</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="UOM: activate to sort column descending"
   aria-sort="ascending">UOM</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="RATE: activate to sort column descending"
   aria-sort="ascending">RATE</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="OPENING INVENTORY: activate to sort column descending"
   aria-sort="ascending">OPENING INVENTORY</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="QUANTITY AVAILABLE: activate to sort column descending"
   aria-sort="ascending">QUANTITY AVAILABLE</th>



  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="SUPPLIER ID: activate to sort column descending"
   aria-sort="ascending">SUPPLIER ID</th>


<th> <a href="{{url('/create_raw_materials_form')}}" class="btn btn-warning">ADD RAW MATERIALS</BUTTON></th>
</tr>







 </thead>

 <tbody>
 @foreach($rms as $rm)
<tr>
<td>{{$rm->id}}</td>
<td>{{$rm->name}}</td>
<td>{{$rm->type}}</td>

<td>{{$rm->uom}}</td>
<td>{{$rm->rate}}</td>

<td>{{$rm->op_inv}}</td>
<td>{{$rm->qty_available}}</td>
<td>{{$rm->supp_id}}</td>

<td>
<button id="edit" type="button"  name= "edit" class="btn btn-success" >EDIT</button>
<button type="button"  id="delete" name="delete"  class="btn btn-danger delete_class" >DELETE</button>
<button type="button"  id="delete" name="delete"  class="btn btn-warning delete_class" onclick="report({{$rm->id}})">LEDGER</button>
</td>
</tr>
@endforeach






 </tbody>
 <tfoot></tfoot>
</table>

                     







                </div>
                 </div>
                 </div>
                 </div>
                 </div>






                     







                







<!-- defining modal links-->

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

 -->
<!-- defining modal links-->


<!-- defining modal -->

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">Edit Form</h4>
            </div>

            <div class="modal-body">
             

<br><br><br>
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"><label for="name" class="col-md-4 control-label">Name</label>
<div class="col-md-6"><input id="name" value="{{old('name')}}" style="text-transform:uppercase" type="text" class="form-control" name="name" autofocus required></div>
</div>
<div class="form-group{{ $errors->has('pack_size') ? ' has-error' : '' }}"><label for="pack_size" class="col-md-4 control-label">Pack Size</label>
<div class="col-md-6"><input id="pack_size" type="text" value="{{old ('pack_size')}}" class="form-control" name="pack_size"></div>
</div>
<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}"><label for="name"  class="col-md-4 control-label">Type</label>
<div class="col-md-6"><input id="type" style="text-transform:uppercase" value="{{old ('type')}}" type="text" class="form-control" name="type"></div>
</div>
<!-- <div class="form-group{{ $errors->has('uom') ? ' has-error' : '' }}"><label for="uom" class="col-md-4 control-label">UOM</label>
<div class="col-md-6"><select id="uom" class="form-control"  value="{{old ('uom')}}" name="uom" autofocus required>
<option value="Kg.">Kg.</option>
<option value="No.">No.</option>
<option value="Liter">Liter</option>
<option value="Drum">Drum</option>
<option value="KG">Gallon</option>
<option value="KG">Quarter</option>
</select></div>
</div> -->
<div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}"><label for="rate"  class="col-md-4 control-label">Rate</label>
<div class="col-md-6"><input id="rate" style="text-transform:uppercase" value="{{old('rate')}}" type="number" class="form-control" name="rate"></div>
</div>
<div class="form-group{{ $errors->has('op_inv') ? ' has-error' : '' }}"><label for="op_inv" class="col-md-4 control-label">Opening Inventory</label>
<div class="col-md-6"><input id="op_inv" type="number" value="{{old ('op_inv')}}" class="form-control" name="op_inv"></div>
</div>
<!-- <div class="form-group{{ $errors->has('supp_id') ? ' has-error' : '' }}"><label for="op_inv" class="col-md-4 control-label">Supplier</label>
<div class="col-md-6"><select id="supp_id" value="{{old ('supp_id')}}" class="form-control" name="supp_id" autofocus required>
@foreach($allsuppliers as $allsupplier)
<option value="{{$allsupplier->id}}">{{$allsupplier->name}}</option>
</select>
@endforeach

</div>
</div> -->
<div class="form-group" align="right">
<div class="col-md-8 col-md-offset-4">
  <button type="button" class="btn btn-primary" id="save">Save</button> 

</div>
</div>




            </div>
            <div class="modal-footer">
               
                
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


$('#delete').click(function(){

var r;
$('#datatable-responsive').find('tr').click(function(){

    r=($(this).index()+1);
   




   var table =document.getElementById('datatable-responsive');
 
  var rm_id = document.getElementById("datatable-responsive").rows[r].cells[0].innerHTML;
  //alert(rm_id);
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 
   $.ajax({

    type: 'POST',

    url: '{{URL::to('delete_raw_materials')}}' ,
    data: {
     
    'rm_id' : rm_id,
     } ,

    success:function(data)

    {
    table.deleteRow(r);
     console.log("raw material deleted successfully");
       window.location.reload();

}});


   });


});



$('#edit').click(function(){

var r;
var rm_id;
$('#datatable-responsive').find('tr').click(function(){

    r=($(this).index()+1);
   



   var table =document.getElementById('datatable-responsive');
 
  rm_id = document.getElementById("datatable-responsive").rows[r].cells[0].innerHTML;
 
 //alert(rm_id);
   $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 
   $.ajax({

    type: 'GET',
    url: '{{URL::to('rm_det')}}' ,
    data: {
     
    'rm_id' : rm_id,
     } ,

    success:function(data)

    {
      
     console.log(data);
     console.log("raw_material edited successfully");
   // alert(data[0].rate); 
   $('#op_inv').val(data[0].op_inv);
   $('#name').val(data[0].name);  
   $('#type').val(data[0].type);
   $('#pack_size').val(data[0].pack_size);
   $('#rate').val(data[0].rate);
   $("#myModal").modal('show');  


    



}});



 
 });



$('#save').click(function(){

  var name=document.getElementById('name').value;
  var rate=document.getElementById('rate').value;
  var pack_size=document.getElementById('pack_size').value;
  var type=document.getElementById('type').value;
  var op_inv=document.getElementById('op_inv').value;
 

  
   $.ajax({

    type: 'POST',

    url: '{{URL::to('edit_raw_material')}}' ,
    data: {
    'rm_id':rm_id,
    'name':name,
    'rate':rate,
    'pack_size':pack_size,
    'type':type,
    'op_inv':op_inv,
     } ,

    success:function(data)

    {
     $('#myModal').modal('hide');
    
     console.log("raw material updated successfully");
     
      window.location.reload();

}});


   });


});



function report(id){


var a="{{url('/raw_materials_ledger_report/')}}";
var b= "/" + id;

var res=a.concat(b);

  window.location=res;
}

</script>

@endsection