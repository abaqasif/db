@extends('layouts.master_layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All Salesmen</div>
                    <div class="panel-body">

                        <a href="{{route('route', ['id' => 1])}}" > Sales route</a>

                        <table class="table">
                            <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Cell</th>
                                <th>Cell other</th>
                                <th>Sleep</th>
                                <th>party</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($salesmen as $sale)
                                <tr>
                                    {{--<th scope="row">1</th>--}}
                                    <td>{{$sale->id}}</td>
                                    <td>  <a href="{{route('salesmen.show',$sale->id)}}"> {{$sale->name}}</a></td>
                                    <td>{{$sale->cell}}</td>
                                    <td> {{ $sale->cell_other}}</td>
                                    <td>{{$sale->sleep}}</td>
                                    {{--<td>{{$sale->party_id}}</td>--}}
                                    <td> @foreach($sale->party as $party)        {{$party->name }}  ,      @endforeach  </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>


                        <a class="btn btn-link" href="{{ url('/salesmen/create') }}">Add a new user</a>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection