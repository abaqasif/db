@extends('layouts.master_layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Party</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/party') }}">
                            {{ csrf_field() }}


                            {{--*********************NAME*************************--}}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            {{--*********************Area*************************--}}

                            <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                                <label for="area" class="col-md-4 control-label">Area</label>

                                <div class="col-md-6">
                                    <input id="area" type="text" class="form-control" name="area" value="{{ old('area') }}" required >

                                    @if ($errors->has('area'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            {{--*********************ADDRESS*************************--}}

                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address')}}"  required>

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            {{--*********************fax*************************--}}


                            <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                                <label for="fax" class="col-md-4 control-label">Fax No</label>

                                <div class="col-md-6">
                                    <input id="fax" type="text" class="form-control" name="fax" value="{{ old('fax') }}"  >

                                    @if ($errors->has('fax'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            {{--*********************mobile*************************--}}

                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label for="mobile" class="col-md-4 control-label">Mobile</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}"  required>

                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--*********************BALANCE*************************--}}


                            <div class="form-group{{ $errors->has('balance') ? ' has-error' : '' }}">
                                <label for="balance" class="col-md-4 control-label">Balance</label>

                                <div class="col-md-6">
                                    <input id="balance" type="text" class="form-control" name="balance" value="{{ old('balance') }}" required>

                                    @if ($errors->has('balance'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('balance') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--*********************OPENING BALANCE*************************--}}


                            <div class="form-group{{ $errors->has('open_balance') ? ' has-error' : '' }}">
                                <label for="balance" class="col-md-4 control-label">Opening Balance</label>

                                <div class="col-md-6">
                                    <input id="open_balance" type="text" class="form-control" name="open_balance" value="{{ old('open_balance') }}" required>

                                    @if ($errors->has('open_balance'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('open_balance') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            {{--*********************Credit_limit*************************--}}


                            <div class="form-group{{ $errors->has('credit_limit') ? ' has-error' : '' }}">
                                <label for="credit_limit" class="col-md-4 control-label">Credit Limit </label>

                                <div class="col-md-6">
                                    <input id="credit_limit" type="text" class="form-control" name="credit_limit" value="{{ old('credit_limit') }}"  required>

                                    @if ($errors->has('credit_limit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('credit_limit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            {{--*********************Day*************************--}}

                            <div class="form-group{{ $errors->has('day') ? ' has-error' : '' }}">
                                <label for="day" class="col-md-4 control-label">Day</label>

                                <div class="col-md-6">
                                    <input id="day" type="text" class="form-control" name="day" value="{{ old('day') }}" required>

                                    @if ($errors->has('day'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('day') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                                            {{--SALESMEN ID--}}

                            <div class="form-group{{ $errors->has('sale_id') ? ' has-error' : '' }}">
                            <label for="sale_id" class="col-md-4 control-label">Salesmen</label>

                            <div class="col-md-6">
                            <input id="sale_id" type="text" class="form-control" name="sale_id" value="{{ old('sale_id') }}" >

                            @if ($errors->has('sale_id"'))
                            <span class="help-block">
                            <strong>{{ $errors->first('sale_id') }}</strong>
                            </span>
                            @endif
                            </div>
                            </div>







                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add
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
