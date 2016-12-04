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
    <h1>Sales Route</h1>
    <h2></h2>
    <hr>
    <br>
</head>
<body>



<table width="100%">
    <thead>
    <tr>

        <th>Salesmen</th>
        <th>Party</th>
        <th>Day</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sm as $po)
    {{--@foreach($po as $p)--}}

            <tr>

            <td>{{$po->name}}</td>
            <td>{{$po->party->name}}</td>
            <td>{{$po->party->day}}</td>
        </tr>
    {{--@endforeach--}}
    @endforeach
    </tbody>
</table>

