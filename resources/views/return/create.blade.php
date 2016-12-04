@extends('layouts.master_layout')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">GOODS RETURN </div>
                    <div class="panel-body">
                        {!! Form::open(array('route' => 'return.store','method'=>'POST','id' => 'jeform')) !!}
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group jename">
                                    <strong>Party:</strong>
                                    <select class="form-control" name="pid">
                                            <option value="{{$order->party->id}}">{{$order->party->name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class='row'>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="item" class='control-label '>Item</label>
                                </div>
                                <div class="col-xs-3">
                                    <label for="qty" class='control-label '>Quantity</label>
                                </div>
                                <div class="col-xs-3">
                                    <label for="disc" class='control-label '>Discount</label>
                                </div>

                            </div>
                        </div>

                        @foreach($order->stock as $st)
                        <div class="row" id="lines">
                            <div class='form-group'>
                                <div class='col-xs-6 ref'>
                                    {{--{!!Form::text('jel_reference[]',null,['class' => 'form-control'])!!}--}}

                                    <select class="form-control" name="item[]">
                                        <option value="{{$st->id}}">{{$st->type." ".$st->brand." ".$st->shade." "}}</option>
                                    </select>
                                </div>
                                <div class='col-xs-3 l1'>
                                    {!!Form::text('qty[]',$st->pivot->quantity,['class' => 'form-control','placeholder' => 'Quantity','required' => 'required'])!!}
                                </div>
                                <div class='col-xs-3 es'>
                                    {!!Form::text('discount[]',$st->pivot->discount,['class' => 'form-control','placeholder' => 'Discount','required' => 'required','readonly'])!!}
                                </div>
                                 </div>
                                </div>
                        @endforeach

                         {{--</div>--}}

                        <div class='row'>
                            <div class="col-xs-12 col-sm-12 col-md-12 alert">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>



                        {!! Form::close() !!}

                </div></div></div></div></div>

    {{--<script>--}}
        {{--$(document).ready(function() {--}}
            {{--jelIndex = 0;--}}

            {{--$('#jeform')--}}

            {{--$('.addButton').on('click', function() {--}}
                {{--jelIndex++;--}}
                {{--console.log('it entered the function');--}}
                {{--var $template = $('#template'),--}}
                        {{--$clone    = $template--}}
                                {{--.clone()--}}
                                {{--.removeClass('hide');--}}
                {{--$('#lines').append($clone);--}}

                {{--console.log('it made the copy');--}}

            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@endsection