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

                  <H4>DATEWISE REPORT</H4>
                  
                    <div class="col-md-6"><input id="datez"  type="date"  class="form-control" name="datez"></div>
                    <button class="btn btn-success" TYPE="BUTTON" onclick="datewise_report()">GENERATE</button>
                    
                    <H4>PURCHASE ORDER REPORT

                    <button class="btn btn-success" TYPE="BUTTON" onclick="group_report()">GENERATE</button></H4>


</div>
</div>
</div>
</div>
</div>



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="x_panel">
                <div class="panel-heading"><h3>All Purchase Orders</h3></div>
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
  aria-label="SUPP_ID: activate to sort column descending"
   aria-sort="ascending">SUPPLIER ID</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="TOTAL: activate to sort column descending"
   aria-sort="ascending">TOTAL</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="REMARKS: activate to sort column descending"
   aria-sort="ascending">REMARKS</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="DATE: activate to sort column descending"
   aria-sort="ascending">DATE</th>


  

<th><a href="{{url('/create_purchases_form')}}" class="btn btn-warning">CREATE PURCHASES</a></th>
</tr>






 </thead>

 <tbody>
 @foreach($purchase_order as $po)
<tr>
<td>{{$po->id}}</td>
<td>{{$po->supp_id}}</td>
<td>{{$po->total}}</td>

<td>{{$po->remarks}}</td>
<td>{{$po->date}}</td>



<td>

<a href="{{url('/delete_purchase_order/'.$po->id)}}" type="button"  id="delete" name="delete"  class="btn btn-danger " >DELETE</button>
<a href="{{url('/view_purchase_order_details/'.$po->id)}}" type="button" class="btn btn-success">VIEW</a>
<a href="{{url('/printInvoice/'.$po->id)}}" type="button" class="btn btn-warning">PRINT</a>


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


function group_report(){

window.location = '/purchase_order_greport';

}


function datewise_report(){
  var m;
m=$('#datez').val();



var x=new Date(m);
var day=x.getDate();
var year=x.getFullYear()+"-";
var month=(x.getMonth()+1)+"-";

var dd=year.concat(month);
//alert(dd);
var date=dd.concat(day);
//alert(date);
var y="/purchase_order_dreport/";
  


  var res = y.concat(date);
  
//alert(res);


window.location = res;


}


</script>

@endsection