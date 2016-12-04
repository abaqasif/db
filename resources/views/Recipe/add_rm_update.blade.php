@extends('layouts.app')


@section('content')
    <div class="container">
        <hr>

        <h2> Add Raw Materials:</h2>
        <h3> For Recipe : {{$rec->id}}</h3>

        {!! Form::open(['url' => '/production/recipe/'.$rec->id.'/rm' ]) !!}

        <div class="form-group">
            {!! Form::label('RM_ID', 'RM_ID', ['class' => 'control-label']) !!}
            {!! Form::text('rm_code',null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('qty', 'Quantity:', ['class' => 'control-label']) !!}
            {!! Form::text('qty',null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}

    </div>

    <div class = "container">
        <td><a href="{{url('/production/recipe/'.$rec->id.'/rm_list')}}" class="btn btn-info">Done Updating</a>
            <p class="lead">List of all your Raw Materials:</p>
            <table class="table table-condensed" style="width:90%">
                <tr>
                    <th>SERIAL NO</th>
                    <th>TYPE</th>
                    <th>QUANTITY</th>
                    <th>UNIT</th>
                    <th>RATE</th>

                    <th></th>
                    <th></th>
                </tr>

                @if(count($raws) != null)
                    @for($x=0; $x<count($raws); $x++)
                        <tr>
                            <td>{{$raws[$x]->rm_code}}</td>
                            <td>{{$raws[$x]->type}}</td>
                            <td>{{$raws[$x]->qty}}</td>
                            <td>{{$raws[$x]->uom}}</td>
                            <td>{{$raws[$x]->rate}}</td>
                            <td><a href="{{url('production/recipe/'.$raws[0]->recipe_id.'/rm/'.$raws[0]->rm_code.'/edit')}}" class="btn btn-info">Update</a>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'url' => ['production/recipe/'.$raws[0]->recipe_id.'/rm/'.$raws[0]->rm_code ] ]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
        @endfor
        @endif



    </div>
    <div class="container">
        <table class="table table-condensed" style="width:90%">
            <tr>
                <th>RM_CODE</th>
                <th>TYPE</th>
                <th>RATE</th>
                <th>UNIT</th>
            </tr>

            @foreach($rms as $rm)
                <tr>

                    <td>{{$rm->rm_code}} </td>
                    <td>{{$rm->type}}</td>
                    <td>{{$rm->rate}}</td>
                    <td>{{$rm->uom}}</td>

                </tr>
        @endforeach

    </div>
@stop