@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>Batch List</h1>
        <br>

        <a href="{{ url('/production/batch/create') }}" class="btn btn-info">Make New Batch</a>

        <br>
        <table class="table table-condensed" style="width:90%">
            <tr>
                <th>Batch ID</th>
                <th>Batch Num</th>
                <th>Batch Date</th>
                <th>Recipe ID</th>
                <th></th>
                <th></th>

            </tr>

            @foreach($batches as $batch)
                <tr>
                    <td>{{$batch->id}}</td>
                    <td>{{$batch->num}}</td>
                    <td>{{$batch->created_at}}</td>
                    <td>{{$batch->recipe_id}}</td>

                    <td>
                    <a href="/production/batch/{{$batch->id}}/tests" class="btn btn-info">Show Test</a>
                    </td>
                    <td>
                        <a href="/production/batch/{{$batch->id}}" class="btn btn-info">Display Batch</a>
                    </td>
                    <td>
                    <td>
                        {!! Form::open(['method' => 'DELETE','route' => ['batch.destroy', $batch->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete Batch', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                    </td>
                    <td>
                        <a href="{{route('batch.edit' , $batch->id)}}" class="btn btn-info">Update Batch</a>
                    </td>
                    <td>
                        <a href="/production/batch/{{$batch->id}}/fill" class="btn btn-info">Filling</a>
                    </td>



                </tr>
        @endforeach
    </div>


@stop