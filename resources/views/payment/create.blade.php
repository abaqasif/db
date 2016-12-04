@extends('layouts.master_layout')


@section('content')



    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Payment</div>
                    <div class="panel-body ">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/payment') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <select class="form-control" name="pid">
                                @foreach($party as $p)
                                    <option value="{{$p->id}}">{{$p->name}}</option>
                                @endforeach
                            </select>
                            </div>


                            <div class="form-group">
                                <label for="cell" class="col-md-4 control-label">Cash</label>

                                <div class="col-md-6">
                                    <input id="cell" type="text" class="form-control" name="cash"  value="0" required>

                                </div>
                            </div>



                            <div class="form-group">
                                <label for="cell" class="col-md-4 control-label">Cheque</label>

                                <div class="col-md-6">
                                    <input id="cell" type="text" class="form-control" name="cheque"  value="0" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cell_other" class="col-md-4 control-label">Token</label>

                                <div class="col-md-6">
                                    <input id="cell_other" type="text" class="form-control" name="token" value="0" required>

                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label for="cell_other" class="col-md-4 control-label">Token</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="cell_other" type="text" class="form-control" name="token" >--}}

                                {{--</div>--}}
                            {{--</div>--}}



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Pay
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
