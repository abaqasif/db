@extends('layouts.master_layout')
@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>

<script type="text/javascript" 
src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="x_panel">
                <div class="panel-heading"><h3>PURCHASE ORDER DETAILS</h3></div>
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
  aria-label="RM: activate to sort column descending"
   aria-sort="ascending">RAW MATERIAL ID</th>


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
  <td>{{$pos->rm_id}}</td>
  <td>{{$pos->qty}}</td>
  <td>{{$pos->rate}}</td>
  <td>{{$pos->tax_rate}}</td>
  <td>{{$pos->tax_amount}}</td>
  <td>{{$pos->total}}</td>
  <td>
  <a href="{{url('/edit_purchase_order_details/'.$pos->id)}}" type="button" class="btn btn-success">EDIT</a>
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





</script>

@endsection