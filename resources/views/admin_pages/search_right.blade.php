
@extends('layouts.master_layout')

@section('content')

<style type="text/css">
table tr {
    
    background-color: #ffffff;
   
}
}

table th {
 
    background-color: #ffffff;
    
}


table td {
     
    background-color: #ffffff;
    
}

table thead{

  table-layout: fixed; width: 100%;
}




</style>



            
               <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<!-- 
                <body>  -->
                <div class="panel-heading"><center><h3>SEARCH RIGHT</h3></center></div>
                <div class="panel-body"> 

<center><label>SEARCH RIGHT </label></center>
<input name="search" id="search" class="form-control" onkeyup="sr()" ></input>
</h3></div>
                <div class="panel-body">
               
                   </style>

 <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>


       {{ csrf_field() }}

 



<br>



<br>
<br>
<br>



<table style="width:100%" class="table" >

<thead>
<tr>
  
     
  
    <th>USER ID</th>
    <th>PAGE ID</th>
    <th>USER NAME</th> 
    <th>PAGE NAME</th>
    <th>URL</th>
   
    
  
</tr>
</thead>
<tbody >

</tbody>


</div>

</div>

<script type="text/javascript">
function sr(){

$value=document.getElementById("search").value;


$.ajax({

type: 'get',
url: '{{URL::to('r_search')}}' ,
data: {'search':$value} ,
success:function(data)

{

if(data.no!=="")
 { $('tbody').html(data);}


}});
}







</script>
@endsection

