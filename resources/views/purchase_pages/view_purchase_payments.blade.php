@extends('layouts.master_layout')
@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="x_panel">
                <div class="panel-heading"><h3>All Payments</h3></div>
                <div class="panel-body">


   <table id="datatable-responsive-one" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="120%">
                     


<thead>
<tr>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="ID: activate to sort column descending"
   aria-sort="ascending">ID</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="NAME: activate to sort column descending"
   aria-sort="ascending">SUPPLIER</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="TYPE: activate to sort column descending"
   aria-sort="ascending">PURCHASE RECEIPT ID</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="UOM: activate to sort column descending"
   aria-sort="ascending">CHEQUE NUMBER</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="RATE: activate to sort column descending"
   aria-sort="ascending">REMARKS</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="OPENING INVENTORY: activate to sort column descending"
   aria-sort="ascending">TOTAL</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="QUANTITY AVAILABLE: activate to sort column descending"
   aria-sort="ascending">DATE</th>
   <th></th>

</tr>






 </thead>

 <tbody>
@foreach ($output as $out)
<tr>
<td>{{$out->id}}</td>
<td>{{$out->supp_name}}</td>
<td>{{$out->pr_id}}</td>

<td>{{$out->ch_no}}</td>
<td>{{$out->remarks}}</td>

<td>{{$out->total}}</td>
<td>{{$out->date}}</td>


<td>
<button id="edit" type="button"  name= "edit" class="btn btn-success" onclick="edit({{$out->id}})">EDIT</button>
<a href="{{url('/delete_purchase_payments/{{$out->id}}')}}" type="button"  id="delete" name="delete"  class="btn btn-danger delete_class" >DELETE</a>
<a href="{{url('/payment_voucher/{{$out->id}}')}}" type="button"    class="btn btn-warning " >PRINT</a>

</td>
</tr>
@endforeach






 </tbody>
 <tfoot></tfoot>
</table>

                     
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">Edit Form</h4>
            </div>

            <div class="modal-body">

<div class="form-group{{ $errors->has('check_no') ? ' has-error' : '' }}"><label for="check_no" class="col-md-4 control-label">CHEQUE NUMBER*</label>
<div class="col-md-6"><input id="check_no" type="text" value="{{old ('check_no')}}" class="form-control" name="check_no" autofocus required></input></div>
</div>
<div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}"><label for="remarks"  class="col-md-4 control-label">REMARKS</label>
<div class="col-md-6"><input id="remarks" style="text-transform:uppercase" value="{{old ('remarks')}}" type="text" class="form-control" name="remarks" autofocus required></input></div>
</div>
<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}"><label for="rate"  class="col-md-4 control-label">DATE*</label>
<div class="col-md-6"><input id="date" style="text-transform:uppercase" value="{{old ('date')}}" type="date" class="form-control" name="date" autofocus required></input></div>
</div>
<div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}"><label for="op_inv" class="col-md-4 control-label">AMOUNT*</label>
<div class="col-md-6"><input id="total" type="number" value="{{old ('total')}}" class="form-control" name="total" autofocus required></input></div>
</div>



              <div class="form-group" align="right">
<div class="col-md-8 col-md-offset-4">
  <button type="button" class="btn btn-primary" id="save" onclick="save()">Save</button> 

</div>
</div>




            </div>
            <div class="modal-footer">
               
                
            </div>
        </div>
    </div>
</div>






                </div>
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




                 <script >

             var pay_id;
    $('#datatable-responsive-one').DataTable();



function edit(id){


pay_id=id;

               $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 
   $.ajax({

    type: 'GET',
    url: '{{URL::to('purchase_payments_det')}}' ,
    data: {
     
    'id' : id,
     } ,

    success:function(data)

    {
      
     console.log(data);
    
   
   $('#check_no').val(data[0].cheque_no);
   $('#remarks').val(data[0].remarks);  
   $('#total').val(data[0].total);
   $('#date').val(data[0].date);
   $("#myModal").modal('show');  


    



}});


}
 
 
 function save(){

var cheque_no=document.getElementById('check_no').value;
var remarks=document.getElementById('remarks').value;
var total=document.getElementById('total').value;
var date=document.getElementById('date').value;

  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 
   $.ajax({

    type: 'POST',
    url: '{{URL::to('update_purchase_payments')}}' ,
    data: {
     'id' : pay_id,
    'cheque_no' : cheque_no,
    'remarks' : remarks,
    'total' : total,
    'date' :date ,
     } ,

    success:function(data)

    {
      
     console.log(data);
    
   $("#myModal").modal('hide');  
   location.reload();

    



}});


 }
             





                 </script>

                 @endsection