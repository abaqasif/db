@extends('layouts.app')


@section('content')

    <div class="container">
        <hr>
        <h2>Items in Stock:</h2>
        {!! Form::open(['url' => '/production/item/rtrv' ]) !!}

        <div class="form-group">
            {!! Form::label('item', 'Get Item:', ['class' => 'control-label']) !!}
            {!! Form::number('item' ,null, ['class' => 'form-control']) !!}
        </div>


        {!! Form::submit('Select', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}

    </div>

    @if(count($item)>0 && count($filling)>0 && count($batch)>0)
    <div class="container">
        <h3>Item ID: {!! $item->id !!}</h3>
        <h5>Brand: {{$recipe->brand}}</h5>
        <h5>Type:  {{$recipe->type}}</h5>
        <h5>Shade: {{$recipe->shade}}</h5>
        <h5>Size: {{$packing->name}}</h5>

        <h5>Min_Stock: {{$recipe->min_stock}}</h5>
        <h5>Price: {{$item->price}}</h5>
        <h5>Cost_price: {{$item->cost_price}}</h5>


    </div>
@endif
@stop