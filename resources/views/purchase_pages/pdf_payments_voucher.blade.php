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
<H1>PAYMENT VOUCHER</H1>
<HR>


</head>



<body>
<table width="100%"> 

<thead>

 @foreach($output as $out)
<tr>
<td><strong>ID</strong></td><td> {{$out->id}}</td>
</tr>
<tr>
<td><strong>SUPPLIER</strong> </td><td>{{$out->supp_name}}</td>
</tr>
<tr>
<td><strong>PURCHASE RECEIPT ID</strong><td>{{$out->pr_id}}</td>
</tr>
<tr>
<td><strong>CHEQUE NO</strong></td><td>{{$out->ch_no}}</td>
</tr>
<tr>
<td><strong>REMARKS</strong></td><td>{{$out->remarks}}</td>
</tr>
<tr>
<td><strong>TOTAL</strong></td><td>{{$out->total}}</td>
</tr>
<tr>
<td><strong>DATE</strong></td><td>{{$out->date}}</td>
</tr>


 @endforeach
 </thead>

</table>
</body>
</html>