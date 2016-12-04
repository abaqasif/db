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
	<th>ID</th>
	<th>SUPPLIER ID</th>
	<th>REMARKS</th>
	<th>TOTAL</th>
	<th>DATE</th>
	</tr>
    </thead>
    <tbody>
    @foreach($pur_order as $po)	
    <tr>
	<td>{{$po->id}}</td>
	<td>{{$po->supp_id}}</td>
	<td>{{$po->remarks}}</td>
	<td>{{$po->total}}</td>
	<td>{{$po->date}}</td>
	</tr>
	@endforeach
    </tbody>
</table>

