@extends('layouts.master_layout')

@section('content')
    <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All Parties </div>
                    <div class="panel-body">


                        <div class="table-responsive">
                        <table class="table table-hover table-inverse">
                            <thead >
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Balance</th>
                                <th>Opening Balance</th>
                                <th>Credit Limit</th>
                                <th>Fax</th>
                                <th>Mobile</th>
                                {{--<th>Sales orders</th>--}}
                                <th>Salesman</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($party as $sale)
                                <tr>
                                    {{--<th scope="row">1</th>--}}
                                    <td>{{$sale->id}}</td>
                                    <td>  <a href="{{route('party.show',$sale->id)}}"> {{$sale->name}}</a></td>
                                    <td>{{$sale->balance}}</td>
                                    <td>{{$sale->open_balance}}</td>
                                    <td>{{$sale->credit_limit}}</td>
                                    <td>{{$sale->fax}}</td>
                                    <td>{{$sale->mobile}}</td>
                                    {{--<td> @foreach($sale->sales_order as $order)        {{$order->total }}  ,      @endforeach  </td>--}}
                                    <td>{{  $sale->salesmen->name}}  </td>
                                    <td > <a style="color: #096e9c" href="{{route('sales_ledger', ['id' => $sale->id])}}"><span class="btn-xs btn-primary">Ledger</span></a></td>

                                    {{--<td><a href="{{route('payment.show',$sale->id)}}" class="btn-sm btn-primary">delivered</a></td>--}}

                                    {{--FOR PARTY ACCESS ITS SALESMEN NAME--}}
                                    {{--@if($sale->cell_other = ''){{ $sale->cell_other}} @endif--}}
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                            </div>


                        <a class="btn btn-link" href="{{ url('/party/create') }}">Add a new user</a>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection