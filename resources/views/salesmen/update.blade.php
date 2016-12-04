@extends('layouts.master_layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Salesmen</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="/salesmen/{{$sale->id}}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />




                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="enter NAME" value="{{$sale->name}}" required>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('cell') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <label for="cell" class="control-label">Cell</label>
                                    <input type="text" name="cell" class="form-control" placeholder="enter cell" value="{{$sale->cell}}" required>

                                    @if ($errors->has('cell'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('cell') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('cell_other') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <label for="cell_other" class="control-label">Cell (other)</label>
                                    <input type="text" name="cell_other" class="form-control" placeholder="enter cell" value="{{$sale->cell_other}}">
                                    @if ($errors->has('cell_other'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('cell_other') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="sleep" class="col-md-6">Admin</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="1">Yes</label>
                                <label class="radio-inline"><input type="radio" name="optradio" value="0">No</label>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 ">
                                    <input type="submit" name="submit" class = 'btn btn-primary' value="update">
                                </div>
                            </div>

                        </form>


                        <form  method="post" action="/salesmen/{{$sale->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <input type="hidden" name="_method" value="DELETE">
                            <br>
                            <input type="submit"  class = 'btn btn-primary btn-sm' value="Delete Salesman">

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection