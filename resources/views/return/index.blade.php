@extends('layouts.master_layout')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$party->name}}</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($party->sales_order as $order)
                                <tr>
                                    {{--<th scope="row">1</th>--}}
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->sdate}} </td>
                                    @if($order->ddate!=null)
                                        <td> {{$order->ddate}}</td>
                                    @else
                                        <td> Not delivered </td>
                                    @endif
                                    {{--<td><a href="{{route('order.show',$order->id)}}" class="btn-sm btn-primary">delivered</a></td>--}}
                                    @if($order->ddate!=null)
                                    <td><a href="{{route('return.edit',$order->id)}}" class="btn-sm btn-primary">Return</a></td>
                                    @endif
                                </tr>
                            @endforeach

                            </tbody>
                        </table>


                        <button  onclick="location.href = '{{url('order/create')}}';" id="myButton" class="btn btn-primary btn-lg btn-block" >New order</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection