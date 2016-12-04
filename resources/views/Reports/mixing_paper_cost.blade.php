<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mixing Paper (with cost)</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>
<body>

<div class = "conatiner">
    <h1>Mixing Paper With Cost</h1>
    <h4>Product: {{$recipe[0]->brand ." ". $recipe[0]->type}}</h4>
    <h4>Color: {{$recipe[0]->shade}}</h4>
    <h4>Batch NUM: {{$batch[0]->num}}</h4>
    <h4>DATE: {{$date}}</h4>
    <h4></h4>



    <table  style="width:50%"  >
        <tr>
            <th>S.NO</th>
            <th>CODE</th>
            <th>RAW MATERIAL</th>
            <th>QTY</th>
            <th>ADDITIONAL</th>
            <th>TOTAL</th>
            <th>%AGE</th>
            <th>UNIT</th>
            <th>COST/UNIT</th>
            <th>AMOUNT</th>
            <th>%AGE COST</th>
        </tr>
        @for($x=0 ; $x<count($bds);$x++)

            <tr>
                <td>{{$x+1}}</td>
                <td>{{$bds[$x]->rm_code}}</td>
                <td>{{$bds[$x]->name}}</td>
                <td>{{$bds[$x]->qty}}</td>
                <td>{{$bds[$x]->additional}}</td>
                <td>{{$bds[$x]->total}}</td>
                <td>{{$bds[$x]->percentage_qty}}</td>
                <td>KG</td>
                <td>{{$bds[$x]->rate}}</td>
                <td>{{$bds[$x]->amount}}</td>
                <td>{{$bds[$x]->percentage_cost}}</td>



            </tr>
        @endfor
    </table>
<h3>Total Material: {{$total_qty}}
    <br>   <br>   Total Cost: {{$total_cost}} </h3></div>


</body>