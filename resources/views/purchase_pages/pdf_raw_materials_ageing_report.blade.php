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
<H1>RAW MATERIALS AGEING REPORT</H1>
<HR>
</head>



<body>
<table width="100%"> 

<thead>
<tr>
<th>S.NO</th>
<th>RAW MATERIAL</th>
<th>0-30 DAYS</th>
<th>31-60 DAYS</th>
<th>61-90 DAYS</th>
<th>91-150 DAYS</th>
<th>151-240 DAYS</th>
<th> MORE THAN 240 DAYS</th>
</tr>
</thead>

 <tbody>
<?php $i=0 ?>
 
 @foreach($rm as $rms)

<tr>
<td>{{++$i}}</td>
<td>{{$rms->name}}</td>
<td>
<?php

$A=DB::select('select sum(purchase_receipt.total)as total from raw_materials left join purchase_order_lines on raw_materials.id = purchase_order_lines.rm_id left join purchase_receipt on purchase_order_lines.id=purchase_receipt.purchase_orders_details_id WHERE raw_materials.id='.$rms->id.'  AND DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate) <31 OR DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate)IS NULL');

echo $A[0]->total;

?>

</td>
<td>



<?php 


$B=\DB::select('select sum(purchase_receipt.total)as total from raw_materials left join purchase_order_lines on raw_materials.id = purchase_order_lines.rm_id left join purchase_receipt on purchase_order_lines.id=purchase_receipt.purchase_orders_details_id WHERE raw_materials.id='.$rms->id.' AND DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate) >30 
  AND DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate)<61 OR DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate)IS NULL
  ');
 
 echo $B[0]->total; 

?>



</td>


<td>

<?php
$C=\DB::select('select sum(purchase_receipt.total)as total from raw_materials left join purchase_order_lines on raw_materials.id = purchase_order_lines.rm_id left join purchase_receipt on purchase_order_lines.id=purchase_receipt.purchase_orders_details_id WHERE raw_materials.id='.$rms->id.' AND DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate) >60 
  AND DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate)<91 OR DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate)IS NULL
  ');
 
 echo $C[0]->total; 

?>

</td>


<td>

<?php
$D=\DB::select('select sum(purchase_receipt.total)as total from raw_materials left join purchase_order_lines on raw_materials.id = purchase_order_lines.rm_id left join purchase_receipt on purchase_order_lines.id=purchase_receipt.purchase_orders_details_id WHERE raw_materials.id='.$rms->id.' AND DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate) >90
  AND DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate)<151 OR DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate)IS NULL
  ');
 
 echo $D[0]->total; 

?>

</td>

<td>

<?php
$E=\DB::select('select sum(purchase_receipt.total)as total from raw_materials left join purchase_order_lines on raw_materials.id = purchase_order_lines.rm_id left join purchase_receipt on purchase_order_lines.id=purchase_receipt.purchase_orders_details_id WHERE raw_materials.id='.$rms->id.' AND DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate) >150
  AND DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate)<241 OR DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate)IS NULL
  ');
 
 echo $D[0]->total; 

?>

</td>
<td>

<?php
$D=\DB::select('select sum(purchase_receipt.total)as total from raw_materials left join purchase_order_lines on raw_materials.id = purchase_order_lines.rm_id left join purchase_receipt on purchase_order_lines.id=purchase_receipt.purchase_orders_details_id WHERE raw_materials.id='.$rms->id.' AND DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate) >240
  OR DATEDIFF(CURRENT_DATE(),purchase_receipt.pdate)IS NULL
  ');
 
 echo $D[0]->total; 

?>

</td>



</tr>


 @endforeach






</tbody>
</table>
</body>
</html>
