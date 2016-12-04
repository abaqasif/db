@extends('layouts.app')


@section('content')
    <div class="container">
        <hr>
        <h1>Inventory</h1>
        <h3>From Factory to Warehouse</h3>



        {!! Form::open(['url' => '/inventory/transfer' ]) !!}

        <div class="form-group">
            {!! Form::label('item', 'Item ID', ['class' => 'control-label']) !!}
            {!! Form::number('item' ,null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('qty', 'Quantity', ['class' => 'control-label']) !!}
            {!! Form::number('qty' ,null, ['class' => 'form-control' , 'width' => '50%']) !!}
        </div>


        {!! Form::submit('Transfer', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}



        <table class="table table-condensed" style="width:90%">
            <tr>
                <th>ID</th>
                <th>BRAND</th>
                <th>TYPE</th>
                <th>SHADE</th>
                <th>SIZE</th>
                <th>PRICE</th>
                <th>MIN_STOCK</th>
                <th>FACTORY STOCK</th>
                <th>WAREHOUSE STOCK</th>
            </tr>

            @foreach($stocks as $stock)
                <tr>
                    <td>{{$stock->id}}</td>
                    <td>{{$stock->brand}}</td>
                    <td>{{$stock->type}}</td>
                    <td>{{$stock->shade}}</td>
                    <td>{{$stock->pack_size}}</td>
                    <td>{{$stock->price}}</td>
                    <td>{{$stock->open_bal}}</td>
                    <td>{{$stock->factory}}</td>
                    <td>{{$stock->warehouse}}</td>
                </tr>
        @endforeach

    </div>
@stop