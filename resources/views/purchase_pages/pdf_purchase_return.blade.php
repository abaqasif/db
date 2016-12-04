 

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
<H1>PURCHASE RETURN</H1>
</head>


<body>
<table width="100%"> 

<thead></thead>



 <tbody>
 @foreach($output as $rec)
<tr>
<td><strong>PURCHASE RETURN ID</strong></td>	
<td>{{$rec->purchase_return_id}}</td>
</tr>
<tr>
<td><strong>PURCHASE RECEIPT ID</strong></td>
<td>{{$rec->id}}</td>
</tr>
<tr>
<td><strong>RAW MATERIAL</strong></td>
<td>{{$rec->rm_name}}</td>
</tr>
<tr>
<td><strong>QUANTITY</strong></td>
<td>{{$rec->p_qty}}</td>

</tr>
<tr>
<td><strong>TOTAL</strong></td>
<td>{{$rec->total}}</td>
</tr>
<tr>
<td><strong>DATE</strong></td>
<td>{{$rec->pdate}}</td>
</tr>
@endforeach
</tbody>
</table>
</body>
</html>