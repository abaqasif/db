@extends('layouts.app')


@section('content')
    <div class="container">
        <hr>
        <h2> Record Wastage</h2>



        {!! Form::open(['route' => 'wastage.store']) !!}


        <div class="form-group">
            {!! Form::label('rm_code', 'RM_CODE' , ['class' => 'control-label']) !!}
            {!! Form::text('rm_code' ,null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
            {!! Form::label('qty', 'Quantity', ['class' => 'control-label']) !!}
            {!! Form::text('qty' ,null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('remarks', 'Remarks', ['class' => 'control-label']) !!}
            {!! Form::text('remarks' ,null, ['class' => 'form-control']) !!}
        </div>


        {!! Form::submit('Select', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}



        <table class="table table-condensed" style="width:90%">
            <tr>
                <th>RM_CODE</th>
                <th>DESC</th>
                <th>RATE</th>

            </tr>

            @foreach($rms as $rm)
                <tr>

                    <td>{{$rm->rm_code}} </td>
                    <td>{{$rm->name}}</td>
                    <td>{{$rm->rate}}</td>

                </tr>
        @endforeach

    </div>
@stop