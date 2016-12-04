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
<H1>SUPPLIERS</H1>
<HR>


</head>



<body>
<table width="100%"> 

<thead>
<tr>
<th>ID</th>
<th>NAME</th>
<th>ADDRESS</th>
<th>PAYMENT TERM</th>
<th>STATUS</th>
</tr>
</thead>



<tbody>
 @foreach($supp as $su)
<tr>
<td>{{$su->id}}</td>
<td>{{$su->name}}</td>
<td>{{$su->address}}</td>
<td>{{$su->payment_term}}</td>
@if($su->pod ==null)
<td>INACTIVE</td>
@endif
@if($su->pod !=null)
<td>ACTIVE</td>
@endif
<!-- <td>{{$su->pod}}</td> -->
</tr>
 @endforeach
</tbody>

</table>
</body>
</html>
