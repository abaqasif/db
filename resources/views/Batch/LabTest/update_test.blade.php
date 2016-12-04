@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Update Lab Test</h1>

        <h3>For Batch_ID : {{$batch[0]->id}}</h3>

        {!!  Form::open(['method' => 'PATCH', 'url' => ['production/batch/'.$batch[0]->id.'/tests/'.$test[0]->id]])  !!}

        <div class="form-group">
            {!! Form::label('name', 'Name:' . $test[0]->name, ['class' => 'control-label']) !!}
            {{--{!! Form::label('name', $test->name) !!}--}}
        </div>

        <div class="form-group">
            {!! Form::label('standard', 'Standard: ' . $test[0]->standard , ['class' => 'control-label']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('title', 'Value:', ['class' => 'control-label']) !!}
            {!! Form::text('value', $test[0]->qty, ['class' => 'form-control']) !!}
        </div>


        {!! Form::submit('Update Test', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection

