@extends('layouts.app')


@section('content')
    <div class="container">
        <hr>
        <h2>Update Batch</h2>


        {!!  Form::open(['method' => 'PATCH', 'url' => ['/production/batch/'.$batch->id.'/header_update_store']])  !!}

        <div class="form-group">
            {!! Form::label('item', 'Item ID: '.$batch->recipe_id, ['class' => 'control-label']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('batch_size', 'Batch Size', ['class' => 'control-label']) !!}
            {!! Form::number('size' ,$batch->batch_size, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('gw', 'Gross Weight', ['class' => 'control-label']) !!}
            {!! Form::number('gw' ,$batch->gross_weight, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('ew', 'Empty Weight', ['class' => 'control-label']) !!}
            {!! Form::number('ew' ,$batch->empty_weight, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('order_no', 'Order #', ['class' => 'control-label']) !!}
            {!! Form::number('order_no' ,$batch->order_no, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}


    </div>
@stop