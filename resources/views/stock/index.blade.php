@extends('layouts.master_layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><Total></Total> Stock</div>
                    <div class="panel-body">



                        <table class="table">
                            <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Brand</th>
                                <th>Shade</th>
                                <th>Type</th>
                                <th>Rate</th>
                                <th>Opening Balance</th>
                                <th>Pack Size</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stocks as $stock)
                                <tr>
                                    {{--<th scope="row">1</th>--}}
                                    <td>{{$stock->id}}</td>
                                    {{--<td>  <a href="{{route('stock.index',$stock->id)}}"> {{$stock->name}}</a></td>--}}
                                    <td>{{$stock->brand}}</td>
                                    <td> {{ $stock->shade}}</td>
                                    <td>{{$stock->type}}</td>
                                    <td>{{$stock->rate}}</td>
                                    <td>{{$stock->open_bal}}</td>
                                    <td>{{$stock->pack_size}}</td>
                                    <td>{{$stock->quantity}}</td>
                                    {{--<td>{{$sale->party_id}}</td>--}}
                                    </tr>
                            @endforeach

                            </tbody>
                        </table>


                        {{--<a class="btn btn-link" href="{{ url('/salesmen/create') }}">Add a new user</a>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection