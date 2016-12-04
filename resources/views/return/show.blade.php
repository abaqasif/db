@extends('layouts.master_layout')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All Sales Return</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Return Date</th>
                                <th>Total</th>
                                <th>Party</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($return as $r)
                                <tr>
                                    {{--<th scope="row">1</th>--}}
                                    <td>{{$r->id}}</td>
                                    <td> {{$r->rdate}}</td>
                                    <td>{{$r->total}}</td>
                                    <td>{{$r->party->name}} </td>
                                    <td > <a style="color: #096e9c" href="{{route('return', ['id' => $r->id])}}"><span class="glyphicon glyphicon-eye-open"></span></a></td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>


                        {{--<button  onclick="location.href = '{{url('order/create')}}';" id="myButton" class="btn btn-primary btn-lg btn-block" >New order</button>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection