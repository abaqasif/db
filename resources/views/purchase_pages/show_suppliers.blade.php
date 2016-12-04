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
                    
                    <H4>ALL SUPPLIERS
                
                    <a href="{{url('/list_of_suppliers')}}" class="btn btn-success" TYPE="BUTTON" >GENERATE</a></H4>



</div>
</div>
</div>
</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="x_panel">
                <div class="panel-heading"><h3>All Suppliers</h3></div>
                <div class="panel-body">

    

                <div id ="warn" class="alert alert-danger alert-dismissible fade in" role="alert" style="visibility:hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>RAW MATERIALS EXISTS AGAINST THIS SUPPLIER. UNABLE TO DELETE!</strong> 
                  </div>
<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >


                     



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
  aria-label="ADDRESS: activate to sort column descending"
   aria-sort="ascending">ADDRESS</th>


<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="PAYMENT TERM: activate to sort column descending"
   aria-sort="ascending">PAYMENT TERM</th>


<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="CONTACT PERSON: activate to sort column descending"
   aria-sort="ascending">CONTACT PERSON</th>

   <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" 
  rowspan="1" colspan="1" style="width: 73px;" 
  aria-label="PHONE NUMBER: activate to sort column descending"
   aria-sort="ascending">PHONE NUMBER</th>


<th> <a href="{{url('/create_suppliers_form')}}" class="btn btn-warning">CREATE SUPPLIER</a></th>
</tr>


 
 </thead>

 <tbody>
 @foreach($sups as $sup)
<tr>
<td>{{$sup->id}}</td>
<td>{{$sup->name}}</td>
<td>{{$sup->address}}</td>

<td>{{$sup->payment_term}}</td>
<td>{{$sup->contact_person}}</td>
<td>{{$sup->phone_number}}</td>

<td>

<button id="edit" type="button" class="btn btn-success"  onclick="edit({{$sup->id}})">EDIT/VIEW</button>

<button id="delete" type="button" class="btn btn-danger delete_class">DELETE</button>
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
        

        <div id="myView" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">View Supplier Details</h4>
            </div>

            <div class="modal-body">
             




             <div class="form-group" align="right">
<div class="col-md-8 col-md-offset-4">

</div>
</div>


<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"><label for="v_name" class="col-md-4 control-label">Name</label>
<div class="col-md-6"><span id="v_name"  class="form-control"></span></div>
</div>
<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}"><label for="v_address" class="col-md-4 control-label">Address</label>
<div class="col-md-6"><span id="v_address"  class="form-control"></span></div>
</div>
<div class="form-group{{ $errors->has('owner_name') ? ' has-error' : '' }}"><label for="v_owner_name" class="col-md-4 control-label">Owner Name</label>
<div class="col-md-6"><span id="v_owner_name"  class="form-control"></span></div>
</div>
<div class="form-group{{ $errors->has('owner_number') ? ' has-error' : '' }}"><label for="v_owner_number" class="col-md-4 control-label">Owner Number</label>
<div class="col-md-6"><span id="v_owner_number"  class="form-control"></span></div>
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"><label for="v_email" class="col-md-4 control-label">Email</label>
<div class="col-md-6"><span id="v_email"  class="form-control"></span></div>
</div>
<div class="form-group{{ $errors->has('payment_term') ? ' has-error' : '' }}"><label for="v_payment_term" class="col-md-4 control-label">Payment Term</label>
<div class="col-md-6"><span id="v_payment_term"  class="form-control"></span></div>
</div>
<div class="form-group{{ $errors->has('credit_limit') ? ' has-error' : '' }}"><label for="v_credit_limit" class="col-md-4 control-label">Credit Limit</label>
<div class="col-md-6"><span id="v_credit_limit"  class="form-control"></span></div>
</div>
<div class="form-group{{ $errors->has('web_add') ? ' has-error' : '' }}"><label for="v_web_add" class="col-md-4 control-label">Web Address</label>
<div class="col-md-6"><span id="v_web_add"  class="form-control"></span></div>
</div>




<div class="form-group{{ $errors->has('contact_person') ? ' has-error' : '' }}"><label for="v_contact_person" class="col-md-4 control-label">Contact Person</label>
<div class="col-md-6"><span id="v_contact_person"  class="form-control"></span></div>
</div>
<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}"><label for="v_phone_number" class="col-md-4 control-label">Phone Number</label>
<div class="col-md-6"><span id="v_phone_number"  class="form-control"></span></div>
</div>
<div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}"><label for="v_mobile_number" class="col-md-4 control-label">Mobile Number</label>
<div class="col-md-6"><span id="v_mobile_number"  class="form-control"></span></div>
</div>
<div class="form-group" align="right">
<div class="col-md-8 col-md-offset-4">

</div>
</div>



            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>




<!-- defining modal -->

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">Edit Form</h4>
            </div>

            <div class="modal-body">
             




             <div class="form-group" align="right">
<div class="col-md-8 col-md-offset-4">
<button type="button"  id="save" name="save" class="btn btn-primary">Save</button>
</div>
</div>


<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"><label for="name" class="col-md-4 control-label">Name</label>
<div class="col-md-6"><input id="name" type="text" style="text-transform:uppercase"  class="form-control" name="name"  value="{{old ('name')}}" autofocus required></div>
</div>
<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}"><label for="address" class="col-md-4 control-label">Address</label>
<div class="col-md-6"><input id="address" type="text" style="text-transform:uppercase"  class="form-control" name="address" value="{{old ('address')}}" autofocus required></div>
</div>
<div class="form-group{{ $errors->has('owner_name') ? ' has-error' : '' }}"><label for="op_inv" class="col-md-4 control-label">Owner Name</label>
<div class="col-md-6"><input id="owner_name" type="text" style="text-transform:uppercase"  class="form-control" name="owner_name"></div>
</div>
<div class="form-group{{ $errors->has('owner_number') ? ' has-error' : '' }}"><label for="owner_number" class="col-md-4 control-label">Owner Number</label>
<div class="col-md-6"><input id="owner_number" type="text" class="form-control" name="owner_number" value="{{old ('owner_number')}}"></div>
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"><label for="supp_id" class="col-md-4 control-label">Email</label>
<div class="col-md-6"><input id="email" type="email" style="text-transform:lowercase"  class="form-control"  value="{{old ('email')}}" name="email"></div>
</div>
<div class="form-group{{ $errors->has('payment_term') ? ' has-error' : '' }}"><label for="payment_term" class="col-md-4 control-label">Payment Term</label>
<div class="col-md-6"><input id="payment_term" type="number" class="form-control" name="payment_term" value="{{old ('payment_term')}}" autofocus required></div>
</div>
<div class="form-group{{ $errors->has('credit_limit') ? ' has-error' : '' }}"><label for="credit_limit" class="col-md-4 control-label">Credit Limit</label>
<div class="col-md-6"><input id="credit_limit" type="number" class="form-control" name="credit_limit" value="{{old ('credit_limit')}}"></div>
</div>
<div class="form-group{{ $errors->has('web_add') ? ' has-error' : '' }}"><label for="web_add" class="col-md-4 control-label">Web Address</label>
<div class="col-md-6"><input id="web_add" type="text" class="form-control" style="text-transform:lowercase" value="{{old ('web_add')}}" name="web_add"></div>
</div>




<div class="form-group{{ $errors->has('contact_person') ? ' has-error' : '' }}"><label for="contact_person" class="col-md-4 control-label">Contact Person</label>
<div class="col-md-6"><input id="contact_person"  style="text-transform:uppercase" type="text" class="form-control" value="{{old ('contact_person')}}" name="contact_person" autofocus required></div>
</div>
<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}"><label for="address" class="col-md-4 control-label">Phone Number</label>
<div class="col-md-6"><input id="phone_number" type="text" class="form-control" name="phone_number" value="{{old ('phone_number')}}" autofocus required></div>
</div>
<div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}"><label for="address" class="col-md-4 control-label">Mobile Number</label>
<div class="col-md-6"><input id="mobile_number" type="text" class="form-control" value="{{old ('mobile_number')}}" name="mobile_number"></div>
</div>
<div class="form-group" align="right">
<div class="col-md-8 col-md-offset-4">

</div>
</div>



            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
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
 
  var supplier_id = document.getElementById('datatable-responsive').rows[r].cells[0].innerHTML;

 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
 


   $.ajax({

    type: 'POST',

    url: '{{URL::to('delete_suppliers')}}' ,
    data: {
     
    'supp_id' : supplier_id,
     } ,

    success:function(data)

    {
var d=data;

var n=d.localeCompare("success");


    if(n==0)
  {  table.deleteRow(r);
    console.log("supplier deleted successfully");
    location.reload();
     

  }


    else{

     console.log("could not delete!");
     document.getElementById('warn').style.visibility="visible";

    }

}});


   });


});







function edit(id){

var r;
var supp_id;
/*$('#datatable-responsive').find('tr').click(function(){

    r=($(this).index()+1);
   */



   var table =document.getElementById('datatable-responsive');
 
  /*supp_id = document.getElementById("datatable-responsive").rows[r].cells[0].innerHTML;*/

  supp_id=id;
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

   $.ajax({

    type: 'GET',
    url: '{{URL::to('supp_det')}}' ,
    data: {
     
    'supp_id' : supp_id,
     } ,

    success:function(data)

    {
      
     console.log(data);
     console.log("suppliers edited successfully");
    



$('#name').val(data[0].name);
$('#address').val(data[0].address);
$('#owner_name').val(data[0].owner_name);
$('#owner_number').val(data[0].owner_number);
$('#credit_limit').val(data[0].credit_limit);
$('#payment_term').val(data[0].payment_term);
$('#contact_person').val(data[0].contact_person);
$('#mobile_number').val(data[0].mobile_number);
$('#phone_number').val(data[0].phone_number);





    
 

   $('#myModal').modal('show');  


    



}});



 
/* });*/



$('#save').click(function(){

  var name=document.getElementById('name').value;
  var address=document.getElementById('address').value;
  var owner_name=document.getElementById('owner_name').value;
  var owner_number=document.getElementById('owner_number').value;
  var credit_limit=document.getElementById('credit_limit').value;
   var payment_term=document.getElementById('payment_term').value;
  var contact_person=document.getElementById('contact_person').value;
  var mobile_number=document.getElementById('mobile_number').value;
  var phone_number=document.getElementById('phone_number').value;
 
 

   //alert(name);
  
   $.ajax({

    type: 'POST',

    url: '{{URL::to('edit_supplier')}}' ,
    data: {
    'name': name,
     'address' :address,
     'owner_name':owner_name,
      'owner_number':owner_number,
       'credit_limit':credit_limit,
       'payment_term':payment_term,
       'contact_person':contact_person,
        'mobile_number':mobile_number,
        'phone_number':phone_number,
        'supp_id':supp_id,
     } ,

    success:function(data)

    {
    
     console.log("suppliers updated successfully");
     $('#myModal').modal('hide');
      window.location.reload();

}});


   });


}

            







function view(){

var r;
var supp_id;
$('#datatable-responsive').find('tr').click(function(){

    r=($(this).index()+1);
   



   var table =document.getElementById('datatable-responsive');
 
  supp_id = document.getElementById("datatable-responsive").rows[r].cells[0].innerHTML;
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

   $.ajax({

    type: 'GET',
    url: '{{URL::to('supp_det')}}' ,
    data: {
     
    'supp_id' : supp_id,
     } ,

    success:function(data)

    {
      
     console.log(data);
     console.log("suppliers edited successfully");
    



$('#v_name').text(data[0].name);
$('#v_address').text(data[0].address);
$('#v_owner_name').text(data[0].owner_name);
$('#v_owner_number').text(data[0].owner_number);
$('#v_credit_limit').text(data[0].credit_limit);
$('#v_payment_term').text(data[0].payment_term);
$('#v_contact_person').text(data[0].contact_person);
$('#v_mobile_number').text(data[0].mobile_number);
$('#v_phone_number').text(data[0].phone_number);




   
    

   $('#myView').modal('show');  


    



}});



 
 });






}





</script>
@endsection