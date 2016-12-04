@extends('layouts.master_layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Salesmen</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/salesmen') }}">
                            {{ csrf_field() }}

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

                            <div class="form-group{{ $errors->has('cell') ? ' has-error' : '' }}">
                                <label for="cell" class="col-md-4 control-label">Cell No</label>

                                <div class="col-md-6">
                                    <input id="cell" type="text" class="form-control" name="cell" value="{{ old('cell') }}" >

                                    @if ($errors->has('cell'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('cell') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>




                            {{--<div class="form-group{{ $errors->has('Party_id') ? ' has-error' : '' }}">--}}
                                {{--<label for="Party_id" class="col-md-4 control-label">Party</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="Party_id" type="text" class="form-control" name="Party_id" value="{{ old('Party_id') }}" >--}}

                                    {{--@if ($errors->has('Party_id"'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('Party_id') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}





                            <div class="form-group">
                                <label for="cell_other" class="col-md-4 control-label">cell (other)</label>

                                <div class="col-md-6">
                                    <input id="cell_other" type="text" class="form-control" name="cell_other" >

                                    {{--@if ($errors->has('password'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                </div>
                            </div>




                            <div class="form-group">
                                <label for="admin" class="col-md-4 control-label">Sleep</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="1">Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="0">No</label>
                            </div>




                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
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
