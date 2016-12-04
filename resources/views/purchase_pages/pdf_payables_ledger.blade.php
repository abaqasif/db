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
<H1>PAYABLES LEDGER SUMMARY</H1>
<HR>
</head>



<body>
<table width="100%"> 

<thead>
<tr>
<th>S.NO</th>
<th>SUPPLIER</th>
<th>DEBIT</th>
<th>CREDIT</th>
</tr>
</thead>

 <tbody>
<?php $i=0 ?>
 
 @foreach($ledger as $led)

<tr>
<td>{{++$i}}</td>
<td>{{$led->name}}</td>
<td></td>
<td>{{$led->total}}</td>
</tr>


 @endforeach






</tbody>
</table>
</body>
</html>


