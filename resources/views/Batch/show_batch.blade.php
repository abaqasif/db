@extends('layouts.app')


@section('content')
    <div class="container">

        <h3>Recipe ID: {!! $recipe->id !!}</h3>
        <h5>Item Brand: {{$recipe->brand}}</h5>
        <h5>Item Type:  {{$recipe->type}}</h5>
        <h5>Item shade: {{$recipe->shade}}</h5>
        <h3>Batch ID: {!! $batch->id !!}</h3>
        <h5>BatchSize: {{$batch->batch_size}}</h5>
        <h5>Total Amount: {{$batch->total_amount}}</h5>
        <h5>Total Material: {{$batch->total_material}}</h5>
        <h5>Created By: {{$batch->created_by}}</h5>
        <h5>Created at: {{$batch->created_at}}</h5>
        <h5>Order #: {{$batch->order_no}}</h5>
        <h5>Gross Weight: {{$batch->gross_weight}}</h5>
        <h5>Empty Weight: {{$batch->empty_weight}}</h5>

        <a href="/production/batch/" class="btn btn-info" >Batch Home</a>

    </div>


    <div class = "container">



        <p class="lead">List of all your Raw Materials:</p>

        <table class="table table-condensed" style="width:90%">
            <tr>
                <th>SERIAL NO</th>
                <th>TYPE</th>
                <th>QUANTITY</th>
                <th>ADDITIONAL</th>
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
                  <td>{{$rm->additional}}</td>
                    <td>{{$rm->uom}}</td>
                    <td>{{$rm->rate}}</td>
                    <td>{{$rm->amount}}</td>

                </tr>
        @endforeach

    </div>




    {{--<h4> Total Cost of the Recipe = {{$totalCost}}</h4>--}}
@stop