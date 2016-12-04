@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add a New Raw Material</h1>
        <p class="lead"></p>
        <hr>
        {!!  Form::open(['method' => 'POST','url' => [ '/production/batch/'.$batch->id]])  !!}

        <div class="form-group">
            {!! Form::label('rm_code', 'RM code:', ['class' => 'control-label']) !!}
            {!! Form::text('rm_code', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('qty', 'Quantity:', ['class' => 'control-label']) !!}
            {!! Form::text('qty', null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>
@stop



