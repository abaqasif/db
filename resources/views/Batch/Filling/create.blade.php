@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add filling </h1>


        <h4>Total weight of batch : {{$batch->gross_weight  - $batch->empty_weight}}</h4>
        <h4>Total weight of fillings : {{$total_fill}}</h4>
        <h4>Batch left for filling: {{$batch->gross_weight  - $total_fill  - $batch->empty_weight}}</h4>
        <p class="lead"></p>
        <hr>

        {!! Form::open(['url' => 'production/batch/'.$batch->id.'/fill'] ) !!}

        <div class="form-group">
            {!! Form::label('packing', 'Select Packing', ['class' => 'control-label']) !!}
            <div class="form-group">
                {!! Form::label('packing', 'Select Packing', ['class' => 'control-label']) !!}
                <select class="form-control" name="pck">
                    @foreach($packing as $item)
                        <option value="{{$item->id}}">{{$item->name}}   - {{$item->weight}}  Ltr.</option>
                    @endforeach
                </select>
            </div>

            </div>

        <div class="form-group">
            {!! Form::label('qty', 'Quantity', ['class' => 'control-label']) !!}
            {!! Form::number('qty', null, ['class' => 'form-control']) !!}
        </div>


        {!! Form::submit('Create Filling', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>
@stop