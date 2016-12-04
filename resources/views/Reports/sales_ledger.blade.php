
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
    <h1>SALES LEDGER</h1>
    <h2></h2>
    <hr>
    <br>


</head>
<body>


{{--     $party        --}}

{{--@foreach($orders as $po)--}}

<p><strong>PARTY:</strong> {{$party->name}}</p>
<p><strong>OPENING BALANCE:</strong> {{$party->open_balance}}</p>
{{--@endforeach--}}

@php($cb = $party->open_balance)

<hr>
<br>

<table width="100%">
    <thead>
    <tr>
        <!-- <th>ID</th> -->
        <th>ID</th>
        <th>DATE</th>
        <th>CASH</th>
        <th>TOKEN</th>
        <th>CHEQUE</th>
        <th>DEBIT</th>
        <th>CREDIT</th>
        <th>BALANCE</th>
    </tr>
    </thead>
    <tbody>
    {{--@php($pay=$party->payment)--}}
    @foreach($party->sales_order as $order)
        <tr>
            <th>{{$order->id}}</th>
            <th>{{$order->sdate}}</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>{{$order->total}}</th>
            <th>{{$cb = $cb+$order->total}}</th>
        </tr>
    @endforeach
    @foreach($party->payment as $pay)
        <tr>
            <th>{{$pay->id}}</th>
            <th>{{$pay->pdate}}</th>
            <th>{{$pay->cash}}</th>
            <th>{{$pay->token}}</th>
            <th>{{$pay->cheque}}</th>
            <th>{{$pay->total}}</th>
            <th></th>
            <th>{{$cb = $cb-$pay->total}}</th>
        </tr>
    @endforeach
    </tbody>
</table>



</body>
</html>