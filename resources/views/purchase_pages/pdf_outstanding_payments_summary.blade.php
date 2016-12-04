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
<h1>OUTSTANDING PAYMENTS SUMMARY</h1>
<h2></h2>
<hr>
<br>
</head>
<body>


<TABLE width="100%">

<THEAD>
	<tr>
<th>SUPPLIER</th>
<th>OUTSTANDING AMOUNT</th>
</tr>
</THEAD>


<TBODY>
@foreach ($output as $out)	
<tr>
<td>{{$out->supp_name}}</td>
<td>{{$out->outstanding}}</td>
</tr>
@endforeach
</TBODY>



</TABLE>

</body>
</html>
