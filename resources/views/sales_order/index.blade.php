@extends('layouts.master_layout')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All Sales Orders</div>
                    <div class="panel-body">
                        {{--<a  href="{{route('order_gp')}}" class="btn-sm btn-success">Group Report</a>--}}
                        {{--<td > <a style="color: #096e9c" href="{{route('order', ['id' => $order->id])}}"><span class="glyphicon glyphicon-eye-open"></span></a></td>--}}

                        <table class="table">
                            <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Order Date</th>
                                <th>Party</th>
                                <th>Delivery Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    {{--<th scope="row">1</th>--}}
                                    <td>{{$order->id}}</td>
                                    <td> {{$order->sdate}}</td>
                                    <td>{{$order->party->name}} </td>
                                    <td>{{$order->ddate}} </td>
                                    <td><a href="{{route('order.show',$order->id)}}" class="btn-sm btn-primary">delivered</a></td>
                                    <td><a href="{{route('return.show',$order->party->id)}}" class="btn-sm btn-primary">Return</a></td>
                                    <td>
                                        <form  method="post" action="/order/{{$order->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                        <input type="hidden" name="_method" value="DELETE">
                                        <div>
                                            <div >
                                                <input type="submit" value="delete"  class = 'btn-xs btn-primary'>
                                            </div>
                                        </div>
                                    </form>
                                    </td>
                                    <td > <a style="color: #096e9c" href="{{route('order', ['id' => $order->id])}}"><span class="glyphicon glyphicon-eye-open"></span></a></td>


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