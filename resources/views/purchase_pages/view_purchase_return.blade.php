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
                    <BR>
                    
                    <H4>PURCHASE RETURN NUMBER</H4>

                    <div class="col-md-6"><input id="pod"  type="number"  class="form-control" name="pod"></div>
                    <button class="btn btn-success" TYPE="BUTTON" onclick="group_report()">GENERATE</button>


</div>
</div>
</div>
</div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="x_panel">
                <div class="panel-heading"><h3>Purchase Return</h3></div>
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
  aria-label="PR_ID: activate to sort column descending"
   aria-sort="ascending">PURCHASE RECEIPT ID</th>


  

  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="RM: activate to sort column descending"
   aria-sort="ascending">RAW MATERIAL</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="RQ: activate to sort column descending"
   aria-sort="ascending">RETURNED QUANTITY</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="TOTAL: activate to sort column descending"
   aria-sort="ascending">TOTAL</th>


  <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="DATE: activate to sort column descending"
   aria-sort="ascending">DATE</th>



<th> </th>
</tr>






 </thead>

 <tbody>
 @foreach($output as $rec)
<tr>
<td>{{$rec->id}}</td>
<td>{{$rec->r_id}}</td>


<td>{{$rec->rm_name}}</td>
<td>{{$rec->p_qty}}</td>

<td>{{$rec->total}}</td>
<td>{{$rec->pdate}}</td>


<td>
<a href="{{url('/invoice_purchase_return/'.$rec->id)}}" type="button" class="btn btn-success">PRINT</a>

<a href="{{url('/delete_purchase_return/'.$rec->id)}}" type="button" class="btn btn-danger">DELETE</a>

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


var id=document.getElementById('pod').value;
if(id!="")
{
var x='/invoice_group_purchase_return/';
var res=x.concat(id);


window.location = res;}

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
var y="/purchase_return_dreport/";
  


  var res = y.concat(date);
  
//alert(res);


window.location = res;


}
    </script>

    @endsection