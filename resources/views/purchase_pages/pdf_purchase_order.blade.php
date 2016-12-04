
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



    @foreach($pur_order as $po)	
    
	<p><strong>PURCHASE ORDER ID:</strong> {{$po->id}}</p>
	<p><strong>SUPPLIER:</strong> {{$po->supp_name}}</p>
	<p><strong>REMARKS:</strong> {{$po->remarks}}</p>
	<p><strong>TOTAL:</strong> {{$po->total}}</p>
	<p><strong>DATE:</strong> {{$po->date}}</p>
	
	@endforeach
    

<hr>
<br>

<table width="100%"> 
	<thead>
    <tr>
	<!-- <th>ID</th> -->
	<th>RAW MATERIAL</th>
	<th>QUANTITY</th>
	<th>RATE</th>
	<th>TAX RATE</th>
	<th>TAX AMOUNT</th>
	<th>TOTAL</th>
	</tr>
    </thead>
    <tbody>
    @foreach($pur_order_line as $pos)	
    <tr>
	<!-- <td>{{$pos->id}}</td> -->
	<td>{{$pos->rm_name}}</td>
	<td>{{$pos->qty}}</td>
	<td>{{$pos->rate}}</td>
	<td>{{$pos->tax_rate}}</td>
	<td>{{$pos->tax_amount}}</td>
	<td>{{$pos->total}}</td>
	</tr>
	@endforeach
    </tbody>
</table>



</body>
</html>