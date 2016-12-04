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
<H1>RAW MATERIALS LEDGER REPORT</H1>
<HR>
@foreach($op_inv as $op)
<H3>RAW MATERIAL:{{$op->name}}</H3>
<H3>OPENING INVENTORY :{{$op->op_inv}}</H3>
@endforeach
</head>

<hr>

<body>
<table width="100%"> 

<thead>
<tr>
<th>S.NO</th>
<th>DATE</th>
<th>REMARKS</th>
<th>DEBIT</th>
<th>CREDIT</th>
</tr>
</thead>

 <tbody>
<?php $i=0 ?>
 
 @foreach($pur as $out)

<tr>
<td>{{++$i}}</td>
<td>{{$out->date}}</td>
<td></td>
<td>{{$out->total}}</td>
<td></td>
</tr>


 @endforeach






</tbody>
</table>
</body>
</html>