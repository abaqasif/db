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

        <div class ="container">

            <td>   <a href="/production/batch/{{$batch->id}}/update_header" class="btn btn-info" >Update Batch Header</a> </td>


        </div>

    </div>


    <div class = "container">


        {!! Form::open(['url' => '/production/batch/'.$batch->id.'/done']) !!}

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
                    <td>{{$rm->qty*$batch->batch_size}}</td>
                    <td>{{$rm->additional}}</td>
                    <td>{{$rm->uom}}</td>
                    <td>{{$rm->rate}}</td>
                    <td>{{$rm->rate*$rm->qty*$batch->batch_size}}</td>
                    <td>   <a href="/production/batch/{{$batch->id}}/update_add/{{$rm->rm_code}}" class="btn btn-primary" >Update Additional Quantity</a> </td>
                    <td>   <a href="/production/batch/{{$batch->id}}/del_update/{{$rm->rm_code}}" class="btn btn-danger" >Delete Raw_Material</a> </td>

                </tr>
        @endforeach

    </div>
    <div class="container">
        <h4>Add a New Raw Material</h4>
        <p class="lead"></p>
        <hr>
        {!!  Form::open(['method' => 'POST','url' => [ '/production/batch/'.$batch->id.'/update_rm']])  !!}

        <div class="form-group">
            {!! Form::label('rm_code', 'RM code:', ['class' => 'control-label']) !!}
            {!! Form::text('rm_code', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('qty', 'Quantity:', ['class' => 'control-label']) !!}
            {!! Form::text('qty', null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('ADD', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>

@stop