@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daily Production Report</h1>
        <h4>Give dates you want the report for</h4>
        <p class="lead"></p>
        <hr>

        {!! Form::open(['url' => 'production/dpr_get']) !!}

        <div class="form-group">
            {!! Form::label('from_date', 'From:', ['class' => 'control-label']) !!}
            {!! Form::text('from_date', 'mm/dd/YYYY',  ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('to_date', 'To:', ['class' => 'control-label']) !!}
            {!! Form::text('to_date', 'mm/dd/YYYY', ['class' => 'form-control']) !!}
        </div>



        {!! Form::submit('Get Report', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>
@stop