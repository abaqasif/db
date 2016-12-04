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
    <h1>Daily Production Report</h1>
    <h4>TO:{{ $to_date}}</h4>
    <h4>FROM:{{$from_date}}</h4>
    <h4>DATE:{{$date}}</h4>
</div>

<div class = "container">


    <table  style="width:80%"  >
        <tr>
            <th>SERIAL NO</th>
            <th>PRODUCT</th>
            <th>COLOR</th>
            <th>BATCH_NO</th>
            <th>QTY FILLED</th>
            <th>UNIT</th>
        </tr>
        @for($x=0;$x<count($arr);$x++)

            <tr>
                <td>{{$x+1}}</td>
                <td>{{$arr[$x][0]->brand. " " . $arr[$x][0]->type}}</td>
                <td>{{$arr[$x][0]->shade}}</td>
                <td>{{$arr[$x][0]->num}}</td>
                <td>{{" "}}</td>
                <td>{{$arr[$x][0]->unit}}</td>


            </tr>
        @endfor
    </table>
</div>



</body>