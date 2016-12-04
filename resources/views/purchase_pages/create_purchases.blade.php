@extends('layouts.master_layout')
@section('content')


<style type="text/css">
 div.c1 {text-align: left}
</style>



<style type="text/css">
 div.c1 {text-align: left}
</style>








<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
table, td {
  border: 1px solid black;
}

th{

  border: 1px solid black;
  background-color:   #191970

}
</style>



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="x_panel">
                <div class="panel-heading"><H3>Create Purchase Order</H3></div>
                <hr>
                <div class="panel-body">



<h3>Supplier Information</h3>



<form class="form-horizontal" role="form" >


                       @if(count($errors)>0)

                        <div class="row">

                        <div class="col-md-6">


                        <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach

                        
                        </ul>
                        </div>

                        </div>
                          @endif



                    

<div>
  <label>Date: </label>
  <span id="dte">{{$date}}</span>
  
  </div>
  
<div >
  <LABEL>Supplier</LABEL>

 <div>

  <select id='id' class="form-control" onchange="supp()" >
 <option value=""></option>

    @foreach($supps as $supp)

    <option value="{{ $supp->id}}">{{ $supp->name}}</option>
    @endforeach 


  </select>

</div>











<div class="nav navbar-left panel_toolbox" style= "border:thin">



<DIV><label >Supplier ID:</label> <span id="name" >---</span></DIV> 
<DIV><label >Credit Limit: PKR</label> <span id="climit" >---</span></DIV>    

<DIV><label>Payment Term: </label> <span id="pterm">---</span> <LABEL>DAYS</LABEL></DIV> 
<DIV><label >Address: </label> <span id="address" >---</span></DIV>     
<DIV><label >Contact Person: </label> <span id="contact_person" >---</span></DIV>   
<DIV><label >Phone Number: </label> <span id="phone_number" >---</span></DIV>  
<DIV><label >Mobile Number: </label> <span id="mobile_number" >---</span></DIV>                                  
<br>




<DIV><label >Remarks:</label> <input id="remarks" class="form-control"></input></DIV> 

<br>
<div class="tiles">
  <BR>
<h3>Raw Materials List</h3>

<BR>



  <table width="70%" id="raw_materials" class="table table-striped table-bordered">

    <tr width="70%">

      <th>RAW MATERIAL NAME</th>

      <th>ORDER QUANTITY</th>
      <th>RATE</th>
      <th>TAX %</th>
      <th>TAX AMOUNT</th>
      <th>TOTAL AMOUNT</th>



    </tr>

   <!--  <tr width="70%">

      <td><select id="r_name" class="form-control"></select> </td>


     <td><input  type="number" id="t_qty"></td>
     <td><span id="rate"></span></td>
     <td><input id="tax_p" type="number"></td>
     <td></td>
     <td></td>






   </tr>

 -->



</table>


<button id="add" type="button" class="btn btn-success" onclick="add_row()">add row</button>
<button id="delete" type="button" class="btn btn-danger" onclick="delete_row()">delete row</button>



</div>

<hr>
<label>TOTAL AMOUNT: </label>

<span id="g_total"></span>
&nbsp; &nbsp; 
&nbsp; &nbsp;
&nbsp; &nbsp;
&nbsp; &nbsp; 
&nbsp; &nbsp;
&nbsp; &nbsp; 
&nbsp; &nbsp;
<button id="calculate" type="button" align="right" onclick="getData()" class="btn btn-success">CALCULATE</button>  

<hr>
 



<button  type="button" onclick="getInvoice()" class="btn btn-success">PRINT INVOICE</button> 
<button id="button" type="button" onclick="create_purchase_order()" class="btn btn-danger">SUBMIT</button>
<a  href="{{url('/view_purchase_order')}}" class="btn btn-warning">DONE</a> 

</div>

</div>



<script>
 
var purchase_order_id;
//$('#r_name').empty();
function supp(){


 $value=document.getElementById('id').value;

 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});



 $.ajax({

  type: 'GET',
  url: '{{URL::to('supp_det')}}' ,
  data: {'supp_id' : $value } ,

  success:function(data)

  {
    if(data.no!=="")
    { 


      $('#name').text(document.getElementById('id').value);
      $('#pterm').text(data[0].payment_term);
      $('#climit').text(data[0].credit_limit);

      $('#address').text(data[0].address);

      $('#contact_person').text(data[0].contact_person);
      $('#mobile_number').text(data[0].mobile_number);
      $('#phone_number').text(data[0].phone_number);


   }
   

 }});

    //var temp;
    var r = document.getElementById("raw_materials").rows.length;
    for(var temp=2; temp<r ;temp++){delete_row;}



 $.ajax({

  type: 'get',
  url: '{{URL::to('supplier_rm')}}' ,
  data: {'supplier_id' : $value } ,

  success:function(data)

  {
    if(data.no!=="")
    { 
      console.log(data);
     //document.getElementById('r_name').innerHTML=data;
    $('#r_name').empty().append(data);
   //$('#r_namezz').empty().append(data);
   }
   

 }});









};


function getData(){

 var table = document.getElementById("raw_materials");


 var grand_total=0;
 var qty;
 var rate;
 var Rtax;
 var total;
 var net;

 var r = document.getElementById("raw_materials").rows.length;

 for(var x=1; x<r; x++ ){



//$sid=document.getElementById('id').value;
var name=table.rows[x].cells[0].children[0].value;
//alert(name);



 $.ajax({

  type: 'GET',
  async : false , 
  url: '{{URL::to('rm_name_det')}}' ,
  data: {
    'name' : name,
  } ,

   
  


  success:function(data)

  {
    if(data.no!=="")
    { 
     console.log("rate found");
     //console.log(data);
    //alert(data[0].rate);
    rate=data[0].rate;
    //alert(rate);
   }
   

 }});


//alert(rate);





  qty=table.rows[x].cells[1].children[0].value;
  table.rows[x].cells[2].innerHTML=rate; 
  Rtax=table.rows[x].cells[3].children[0].value;

  if(Rtax==""){table.rows[x].cells[3].children[0].value=0;}

  total=qty * rate;

  tax=(total * Rtax)/100;

  net= total+tax;

  table.rows[x].cells[4].innerHTML=tax;
  table.rows[x].cells[5].innerHTML=net;


  grand_total+=net;



}


document.getElementById("g_total").innerHTML=grand_total;




}







function add_row() {




  var table = document.getElementById("raw_materials");
 // var len= document.getElementById("raw_materials").rows.length;


  var row = table.insertRow(1);
  var cell0 = row.insertCell(0);
  var cell1 = row.insertCell(1);
  var cell2 = row.insertCell(2);
  var cell3 = row.insertCell(3);
  var cell4 = row.insertCell(4);
  var cell5 = row.insertCell(5);



  //cell0.innerHTML=$('#r_name').clone();

  cell0.innerHTML=' <td><select id="r_namezz" class="form-control"></td>';




$v=document.getElementById('id').value;



 $.ajax({

  type: 'get',
  url: '{{URL::to('supplier_rm')}}' ,
  data: {'supplier_id' : $v } ,

  success:function(data)

  {
    if(data.no!=="")
    { 
      console.log(data);
     $('#r_namezz').empty().append(data);
   }
   

 }});


  cell1.innerHTML=' <td><input  type="number" id="t_qty" autofocus required></td>';
  cell2.innerHTML='<td><span id="rate"></td>';
  cell3.innerHTML='<td><input id="tax_p" type="number" autofocus required></td>';
  cell4.innerHTML='<td></td>';
  cell5.innerHTML='<td></td>';


}

function delete_row() {
  document.getElementById("raw_materials").deleteRow(2);
}


function create_purchase_order(){
  getData();
  document.getElementById("add").disabled = true;
  document.getElementById("add").style.visibility = 'hidden';
  document.getElementById("delete").disabled = true;
  document.getElementById("delete").style.visibility = 'hidden';
  document.getElementById("calculate").disabled = true;
  document.getElementById("calculate").style.visibility = 'hidden';
  document.getElementById("id").disabled = true;
  document.getElementById("raw_materials").disabled = true;
  document.getElementById("button").disabled = true;
  document.getElementById("button").style.visibility = 'hidden';






  var table = document.getElementById("raw_materials");
  var r = document.getElementById("raw_materials").rows.length;
/*for(var x=1; x<r ; x++)
{


for(var y=0; y<4 ; y++)

 { table.rows[x].cells[y].children[0].disabled=true;}

}*/



//creating purchase order

var remarks=document.getElementById('remarks').value;
$sup=document.getElementById('id').value;
$tot=document.getElementById('g_total').innerText;
$dt=document.getElementById('dte').innerText;

var PO_ID=0;

 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


$.ajax({

  type: 'POST',
  url: '{{URL::to('create_purchase_order')}}' ,
  async: false,
  data: {

    'supplier_id':$sup,
    'total': $tot,
    'date' :$dt,
    'remarks': remarks,





  } ,

  success:function(data)

  {
   PO_ID=data;
   purchase_order_id=data;
   console.log(PO_ID);
   console.log("purchase order created!");
   
   //purchase_order_id=data;

   

 }});



//creating purchase order line



for(var x=1; x<r ; x++)
{

  

  var rm_id=table.rows[x].cells[0].children[0].value;
  var qty=table.rows[x].cells[1].children[0].value;
  var rate=table.rows[x].cells[2].innerHTML;
  var tax=table.rows[x].cells[3].children[0].value;
  var tax_amount=table.rows[x].cells[4].innerHTML;
  var total=table.rows[x].cells[5].innerHTML;
  



  //alert(rm_id);
  //alert(qty);
  //alert(rate);
  //alert(tax);
  //alert(tax_amount);
  //alert(total);
  //alert(PO_ID);

  $.ajax({

    type: 'POST',
    url: '{{URL::to('create_purchase_order_line')}}' ,
    data: {


      'purchase_id' : PO_ID ,
      'rm_id' : rm_id ,
      'qty' :qty ,
      'rate' :rate ,
      'tax' :tax ,
      'tax_amount' :tax_amount ,
      'total' :total ,






    } ,

    success:function(data)

    {

     console.log("raw material successfully added");




   }});








}


}



function getInvoice(){
  var x=purchase_order_id;
  var y="/printInvoice/";
  


  var res = y.concat(x);
  


 // alert(fin);
  window.location = res;



}

</script>

@endsection