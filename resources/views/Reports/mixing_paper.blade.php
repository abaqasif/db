<!DOCTYPE html>
<html lang="en">
<head>

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
<div class = "container">

    <h1>Mixing Paper</h1>
    <h4>Recipe : {{$recipe[0]->brand ." ". $recipe[0]->type}}</h4>
    <h4>Color: {{$recipe[0]->shade}}</h4>
    <h4>Batch NUM: {{$batch[0]->num}}</h4>
    <h4>order_no: {{$batch[0]->order_no}}</h4>
    <h4>DATE: {{$date}}</h4>
    <h4></h4>


    <h3>Filling Instructions</h3>
    <table  style="width:80%"  >
        <tr>
            <th>LTR</th>
            <th>QUANTITY</th>
            <th>LTR</th>
        </tr>
        @foreach($fillings as $filling)

            <tr>
                <td>{{$filling->pkg_wt}}</td>
                <td>{{$filling->qty}}</td>
                <td>{{$filling->weight}}</td>

            </tr>
        @endforeach
    </table>

    <h3> Total Fillings = {{$total_fill}} ltr.</h3>


    <h3>Lab Test Report</h3>
    <table  style="width:80%"  >
        <tr>
            <th>TEST</th>
            <th>STANDARD</th>
            <th>VALUE</th>
        </tr>
        @foreach($tests as $test)

            <tr>
                <td>{{$test->name}}</td>
                <td>{{$test->standard}}</td>
                <td>{{$test->qty}}</td>


            </tr>
        @endforeach
    </table>
<h3>Batch Details</h3>

    <table  style="width:80%"  >
        <tr>
            <th>S.NO</th>
            <th>CODE</th>
            <th>QTY</th>
            <th>ADDITIONAL</th>
            <th>TOTAL</th>
            <th>UNIT</th>
            <th>PERCENTAGE</th>
        </tr>
        @for($x=0; $x<count($bds); $x++)

            <tr>
                <td>{{$x+1}}</td>
                <td>{{$bds[$x]->rm_code}}</td>
                <td>{{$bds[$x]->qty}}</td>
                <td>{{$bds[$x]->additional}}</td>
                <td>{{$bds[$x]->total}}</td>
                <td>kgs</td>
                <td>{{$bds[$x]->percentage}}</td>

            </tr>
        @endfor
    </table>
</div>

</body>