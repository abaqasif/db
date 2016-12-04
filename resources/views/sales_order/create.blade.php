@extends('layouts.master_layout')


@section('content')

<div @if($message!=null) class="container has-error" @else class="container" @endif >

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Sales Order</div>

                    <div class="panel-body">
                        @if ($message!=null)
                            <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @endif
    {!! Form::open(array('route' => 'order.store','method'=>'POST','id' => 'jeform')) !!}
    <div class="row">

        <div class="col-xs-4 col-sm-4 col-md-4">

            <div class="form-group jename">
                <strong>Party:</strong>
                <select class="form-control" name="pid">
                @foreach($parties as $party)
                    <option value="{{$party->id}}">{{$party->name}}</option>
                @endforeach
                </select>


            </div>

        </div>


    </div>


    <div class='row'>
        {{--<div class="form-group">--}}
            {{--<div class="col-xs-offset-8 col-xs-3 ">--}}
                {{--<button type="button" class="btn btn-primary addButton"><i class="fa fa-plus">Add Item</i></button>--}}
                {{--<button type="button" class="btn btn-primary delButton"><i class="fa fa-plus">Delete Item</i></button>--}}
        {{--</div>--}}

            <div class="col-xs-offset-9 col-xs-2 ">
                <button type="button" class="btn btn-primary addButton"><i class="fa fa-plus">Add Item</i></button>
            </div>
            {{--<div class="col-xs-3">--}}
                {{--<button type="button" class="btn btn-primary delButton"><i class="fa fa-plus">Delete Item</i></button>--}}
            {{--</div>--}}


        </div>
    {{--</div>--}}





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
    <div class="row" id="lines">
        <div class='form-group'>
            <div class='col-xs-6 ref'>
                {{--{!!Form::text('jel_reference[]',null,['class' => 'form-control'])!!}--}}

                <select class="form-control" name="jel_reference[]">
                    @foreach($stock as $st)
                        <option value="{{$st->id}}">{{$st->type." ".$st->brand." ".$st->shade." "}}</option>
                    @endforeach
                </select>


            </div>
            <div class='col-xs-3 l1'>
                {!!Form::text('jel_label[]',null,['class' => 'form-control','placeholder' => 'Quantity','required' => 'required'])!!}
            </div>
            <div class='col-xs-3 es'>
                {!!Form::text('jel_coa_id[]',0,['class' => 'form-control','placeholder' => 'Discount','required' => 'required'])!!}
            </div>

        </div>

        <!--jel stands for journal entry line  -->

    </div>
    {{-- </div> --}}

    <div class='row'>
        <div class="col-xs-12 col-sm-12 col-md-12 alert">                          {{--remove alert--}}
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>



    {!! Form::close() !!}
    <div class='form-group hide'  id='template'>
        <div class='col-xs-6 ref'>
            {{--{!!Form::text('jel_reference[]',null,['class' => 'form-control'])!!}--}}

            <select class="form-control" name="jel_reference[]">
                @foreach($stock as $st)
                    <option value="{{$st->id}}">{{$st->type." ".$st->brand." ".$st->shade." "}}</option>
                @endforeach
            </select>

        </div>
        <div class='col-xs-3 l1'>
            {!!Form::text('jel_label[]',null,['class' => 'form-control','placeholder' => 'Quantity','required' => 'required'])!!}
        </div>
        <div class='col-xs-3 es'>
            {!!Form::text('jel_coa_id[]',0,['class' => 'form-control','placeholder' => 'Discount','required' => 'required'])!!}
        </div>
        {{--<div class='col-xs-3 ea'>--}}
            {{--{!!Form::text('jel_e_a_id[]',null,['class' => 'form-control','placeholder' => 'Entry Against'])!!}--}}
        {{--</div>--}}
        {{--<div class='col-xs-1 ad'>--}}
            {{--{!!Form::number('jel_amt_d[]',null,['class' => 'form-control'])!!}--}}
        {{--</div>--}}
        {{--<div class='col-xs-1 ac'>--}}
            {{--{!!Form::number('jel_amt_c[]',null,['class' => 'form-control'])!!}--}}
        {{--</div>--}}
    </div>


</div>
                </div></div></div></div>

    <script>
        $(document).ready(function() {
                    jelIndex = 0;

            $('#jeform')

            $('.addButton').on('click', function() {
                jelIndex++;
                console.log('it entered the function');
                var $template = $('#template'),
                        $clone    = $template
                                .clone()
                                .removeClass('hide');
                $('#lines').append($clone);

                console.log('it made the copy');

            });
        });
    </script>
@endsection