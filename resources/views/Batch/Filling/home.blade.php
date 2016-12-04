@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Fillings for Batch ID: {{$batch->id}} </h1>

       @if(count($fills)==0)
           <h4>No Fillings created for this Batch yet.</h4>
            <a href="/production/batch/{{$batch->id}}/fill/create" class="btn btn-info">Create New Filling</a>

        @elseif(count($fills)>0)

            <table class="table table-condensed" style="width:90%">
                <tr>
                    <th>Filling ID</th>
                    <th>Packing</th>
                    <th>Quantity</th>
                    <th>Weight</th>
                    <th>Unit</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($fills as $fill)
                    <tr>
                        <td>{{$fill->id}}</td>
                        <td>{{$fill->name}}</td>
                        <td>{{$fill->qty}}</td>
                        <td>{{$fill->weight}}</td>
                        <td>{{$fill->unit}}</td>


                        <td>
                            @if(!$batch->filling_lock)
                            <a href="/production/batch/{{$batch->id}}/fill/{{$fill->id}}/edit" class="btn btn-info">Update</a>
                            @endif
                        </td>

                        <td>
                            @if(!$batch->filling_lock)
                            {!! Form::open(['method' => 'DELETE','route' => ['fill.destroy',$batch->id , $fill->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            @endif
                        </td>


                    </tr>
                @endforeach
                </table>

@if(!$batch->filling_lock)
            <a href="/production/batch/{{$batch->id}}/lock_filling" class="btn btn-info">Lock</a>
                <a href="/production/batch/{{$batch->id}}/fill/create" class="btn btn-info">Create New Filling</a>
            @endif

        {{--@elseif(count($fills)>0 && $filling_date!='')--}}

         {{--<h4>Fillings for this batch has been locked so you are not allowed to edit or create more fillings</h4>--}}
            {{--<table class="table table-condensed" style="width:90%">--}}
                {{--<tr>--}}
                    {{--<th>Filling ID</th>--}}
                    {{--<th>Packing ID</th>--}}
                    {{--<th>Quantity</th>--}}
                    {{--<th>Weight</th>--}}
                    {{--<th>Unit</th>--}}

                {{--</tr>--}}
                {{--@foreach($fills as $fill)--}}
                    {{--<tr>--}}
                        {{--<td>{{$fill->id}}</td>--}}
                        {{--<td>{{$fill->name}}</td>--}}
                        {{--<td>{{$fill->qty}}</td>--}}
                        {{--<td>{{$fill->weight}}</td>--}}
                        {{--<td>{{$fill->unit}}</td>--}}

                    {{--</tr>--}}
                {{--@endforeach--}}
            {{--</table>--}}
        @endif



    </div>
@stop