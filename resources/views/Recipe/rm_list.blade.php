@extends('layouts.app')


@section('content')
    <div class="container">

       <h3>Recipe ID: {!! $recipe->id !!}</h3>
        <h5>Item Brand: {{$recipe->brand}}</h5>
        <h5>Item Type:  {{$recipe->type}}</h5>
        <h5>Item shade: {{$recipe->shade}}</h5>
        <h5>BatchSize: {{$recipe->batchsize}}</h5>



            <table class="table table-condensed" style="width:90%">
                <p class="lead">List of all your Raw Materials:</p>
                <tr>
                    <th>SERIAL NO</th>
                    <th>TYPE</th>
                    <th>QUANTITY</th>
                    <th>UNIT</th>
                    <th>RATE</th>
                    <th>AMOUNT</th>

                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($rms as $rm)
                    <tr>

                        <td>{{$rm->rm_code}}</td>
                        <td>{{$rm->type}}</td>
                        <td>{{$rm->qty}}</td>
                        <td>{{$rm->uom}}</td>
                        <td>{{$rm->rate}}</td>
                        <td>{{$rm->amount}}</td>




                    </tr>
            @endforeach

</table>

    <h4> Total Cost of the Recipe = {{$totalCost}}</h4>
        <a href="{{url('/production/recipe/')}}" class="btn btn-info">Recipe Home</a>
    </div>
@stop

