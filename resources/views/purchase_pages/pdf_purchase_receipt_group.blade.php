 

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
<H1>PURCHASE RECEIPT</H1>
<hr>
<h3><strong>PURCHASE ORDER NO #{{$p_id}}</strong></h3>
</head>


<body>
<table width="100%"> 

<thead></thead>

 <tbody>
 
<thead>
<tr>
<th><strong>PURCHASE RECEIPT ID</strong></th>	
<th><strong>RAW MATERIAL</strong></th>
<th><strong>QUANTITY</strong></th>
<th><strong>TOTAL</strong></th>
<th><strong>DATE</strong></th>
</tr>
</thead>

<tbody>
	@foreach($output as $rec)
<tr>
<td>{{$rec->id}}</td>

<td>{{$rec->rm_name}}</td>

<td>{{$rec->p_qty}}</td>



<td>{{$rec->total}}</td>


<td>{{$rec->pdate}}</td>
</tr>
@endforeach
</tbody>
</table>
</body>
</html>