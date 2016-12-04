@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>Wastage Record</h1>
        <br>

        <a href="{{ route('wastage.create') }}" class="btn btn-info">Add new Wastage</a>


        <br>
        <table class="table table-condensed" style="width:90%">
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>RM ID</th>
                <th>RM name</th>
                <th>QUANTITY</th>
                <th>COST</th>
                <th>REMARKS</th>
                <th></th>
                <th></th>

            </tr>

            @foreach($wastes as $wst)
                <tr>
                    <td>{{$wst->id}}</td>
                    <td>{{$wst->date}}</td>
                    <td>{{$wst->rm_code}}</td>
                    <td>{{$wst->type}}</td>
                    <td>{{$wst->qty}}</td>
                    <td>{{$wst->cost}}</td>
                    <td>{{$wst->remarks}}</td>


                    <td>
                        {!! Form::open(['method' => 'DELETE','route' => ['wastage.destroy', $wst->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>

                    <td>
                        <a href="/production/wastage/{{$wst->id}}/edit" class="btn btn-info">Update</a>
                    </td>




                </tr>
        @endforeach
    </div>

@stop