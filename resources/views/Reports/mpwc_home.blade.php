@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mixing Paper With Cost</h1>
        <h4>Enter batch number to get its mixing paper</h4>
        <p class="lead"></p>
        <hr>

        {!! Form::open(['url' => 'production/mixing_paper_cost']) !!}

        <div class="form-group">
            {!! Form::label('batch_num', 'Batch Number:', ['class' => 'control-label']) !!}
            {!! Form::text('batch_num', null,  ['class' => 'form-control']) !!}
        </div>



        {!! Form::submit('Get Report', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>
@stop