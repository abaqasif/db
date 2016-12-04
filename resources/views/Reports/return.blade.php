
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
    <h1>GOODS RETURN</h1>
    <h2></h2>
    <hr>
    <br>


</head>
<body>



{{--@foreach($orders as $po)--}}

<p><strong>SALES ORDER ID:</strong> {{$orders->id}}</p>
<p><strong>PARTY:</strong> {{$orders->party->name}}</p>
<p><strong>TOTAL:</strong> {{$orders->total}}</p>
<p><strong>DATE:</strong> {{$orders->rdate}}</p>

{{--@endforeach--}}


<hr>
<br>

<table width="100%">
    <thead>
    <tr>
        <!-- <th>ID</th> -->
        <th>S#</th>
        <th>ITEM</th>
        <th>QUANTITY</th>
        <th>RATE</th>
        <th>Discount</th>
    </tr>
    </thead>
    <tbody>
    @php($i=1)
    @foreach($orders->stock as $pos)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$pos->type." ".$pos->brand." ".$pos->shade." "}}</td>
            <td>{{$pos->pivot->quantity}}</td>
            <td>{{$pos->rate}}</td>
            <td>{{$pos->pivot->discount}}</td>
        </tr>
    @endforeach
    </tbody>
</table>



</body>
</html>