@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>Lab Tests</h1>
<h3>For Batch_ID : {{$batch->id}}</h3>
        <br>
        <table class="table table-condensed" style="width:90%">
            <tr>
                <th>Test ID</th>
                <th>Test Name</th>
                <th>Test Standard</th>
                <th>Test Value</th>
                <th></th>
            </tr>


            @foreach($tests  as $test)
                <tr>
                    <td>{{$test->id}}</td>
                    <td>{{$test->name}}</td>
                    <td>{{$test->standard}}</td>
                    <td>{{$test->value}}</td>


                    <td>
                        <a href="/production/batch/{{$batch->id}}/tests/{{$test->id}}/edit" class="btn btn-info">Update</a>
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE','route' => ['tests.destroy', $batch->id, $test->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>


                </tr>
        @endforeach

            <a href="{{url('/production/batch/'.$batch->id.'/tests/create')}} " class="btn btn-info btn-bot">Add Test</a><br>



    </div>
@stop