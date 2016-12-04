<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;

}
</style>
<head>
<h1>PURCHASE ORDER</h1>
<h2></h2>
<hr>
<br>
</head>
<body>



<table width="100%"> 
	<thead>
    <tr>
	
	<th>SUPPLIER ID</th>
	<th>SUPPLIER NAME</th>
	<th>TOTAL PURCHASE ORDERS</th>
	</tr>
    </thead>
    <tbody>
    @foreach($pur_order as $po)	
    <tr>
	
	<td>{{$po->supp_id}}</td>
	<td>{{$po->supp_name}}</td>
	<td>{{$po->tot}}</td>
	</tr>
	@endforeach
    </tbody>
</table>

