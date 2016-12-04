@extends('layouts.app')


@section('content')
    <div class="container">
        <hr>
        <h2> Record Wastage</h2>




        {!! Form::model($waste, [
          'method' => 'PATCH',
          'route' => ['wastage.update', $waste->id]
      ]) !!}


        <div class="form-group">
            {!! Form::label('rm_code', 'RM_CODE' , ['class' => 'control-label']) !!}
            {!! Form::text('rm_code' ,$waste->rm_code, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('qty', 'Quantity', ['class' => 'control-label']) !!}
            {!! Form::text('qty' ,$waste->qty, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('remarks', 'Remarks', ['class' => 'control-label']) !!}
            {!! Form::text('remarks' ,$waste->remarks, ['class' => 'form-control']) !!}
        </div>


        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}



        <table class="table table-condensed" style="width:90%">
            <tr>
                <th>RM_CODE</th>
                <th>TYPE</th>
                <th>RATE</th>

            </tr>

            @foreach($rms as $rm)
                <tr>

                    <td>{{$rm->rm_code}} </td>
                    <td>{{$rm->type}}</td>
                    <td>{{$rm->rate}}</td>

                </tr>
        @endforeach

    </div>
@stop