@extends('layouts.app')


@section('content')
    <div class="container">
        <hr>
        <h2> Select the item you want to make batch of and batch size:</h2>



        {!! Form::open(['route' => 'batch.store' ]) !!}

        <div class="form-group">
            {!! Form::label('item', 'Item ID', ['class' => 'control-label']) !!}
            <select class="form-control" name="item">
                @foreach($items as $item)
                    <option value="{{$item->id}}">{{$item->brand}}  {{$item->type}}     {{$item->shade}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('batchsize', 'Batch Size', ['class' => 'control-label']) !!}
            {!! Form::number('size' ,null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('gw', 'Gross Weight', ['class' => 'control-label']) !!}
            {!! Form::number('gw' ,null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('ew', 'Empty Weight', ['class' => 'control-label']) !!}
            {!! Form::number('ew' ,null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('order_no', 'Order #', ['class' => 'control-label']) !!}
            {!! Form::number('order_no' ,null, ['class' => 'form-control']) !!}
        </div>




        {!! Form::submit('Select', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}



        <table class="table table-condensed" style="width:90%">
            <tr>
                <th>ID</th>
                <th>BRAND</th>
                <th>TYPE</th>
                <th>SHADE</th>
            </tr>

            @foreach($items as $rm)
                <tr>

                    <td>{{$rm->id}} </td>
                    <td>{{$rm->brand}}</td>
                    <td>{{$rm->type}}</td>
                    <td>{{$rm->shade}}</td>
                </tr>
        @endforeach

    </div>
@stop