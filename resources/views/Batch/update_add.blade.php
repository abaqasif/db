@extends('layouts.app')
@section('content')

    <div class="container">
        <hr>
        <h2>Update Additonal Quantity of Raw Material</h2>


        {!!  Form::open(['method' => 'PATCH', 'url' => ['/production/batch/'.$batch->id.'/update_add/'.$bd[0]->rm_code .'/rm_update_store']])  !!}

        <div class="form-group">
            {!! Form::label('item', 'RM_CODE: '.$bd[0]->rm_code, ['class' => 'control-label']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('item', 'Quantity: '.$bd[0]->qty, ['class' => 'control-label']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('qty', 'Additional:', ['class' => 'control-label']) !!}
            {!! Form::text('qty' ,$bd[0]->additional, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}


    </div>
@endsection