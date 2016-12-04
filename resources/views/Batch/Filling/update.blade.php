@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Update filling </h1>

        <p class="lead"></p>
        <hr>

        {!!  Form::open(['method' => 'PATCH', 'url' => ['/production/batch/'.$filling[0]->batch_id.'/fill/'.$filling[0]->id]])  !!}

        <div class="form-group">
            {!! Form::label('packing', 'Packing : ' . $filling[0]->name, ['class' => 'control-label']) !!}
            {{--{{ Form::select('packing', ['drum' => 'drum' , 'gallon' => 'gallon' , 'quarter' => 'quarter'], array('class' => 'form-control')) }}--}}
        </div>

        <div class="form-group">
            {!! Form::label('qty', 'Quantity', ['class' => 'control-label']) !!}
            {!! Form::number('qty',$filling[0]->qty , ['class' => 'form-control']) !!}
        </div>


        {!! Form::submit('Done', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>
@stop
