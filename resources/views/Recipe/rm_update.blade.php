@extends('layouts.app')


@section('content')
    <div class="container">

          <h3>Recipe ID: {!! $recipe->id !!}</h3>
          <h5>Item Brand: {{$recipe->brand}}</h5>
          <h5>Item Type:  {{$recipe->type}}</h5>
          <h5>Item shade: {{$recipe->shade}}</h5>
          <h5>BatchSize: {{$recipe->batchsize}}</h5>
  


        <div class = "container">

            <table class="table table-condensed" style="width:90%">
                <p class="lead">List of all your Raw Materials:</p>
                <tr>
                    <th>SERIAL NO</th>
                    <th>TYPE</th>
                    <th>QUANTITY</th>
                    <th>UNIT</th>
                    <th>RATE</th>

                    <th></th>
                    <th></th>
                </tr>


                @foreach($rms as $rm)
                    <tr>

                        <td>{{$rm->rm_code}}</td>
                        <td>{{$rm->type}}</td>
                        <td>{{$rm->qty}}</td>
                        <td>{{$rm->uom}}</td>
                        <td>{{$rm->rate}}</td>



                       
                        <td><a href="{{url('production/recipe/'.$rm->recipe_id.'/rm/'.$rm->rm_code.'/edit')}}" class="btn btn-info">Update</a>

              

                        <td>
                            {!! Form::open(['method' => 'DELETE', 'url' => ['production/recipe/'.$rm->recipe_id.'/rm/'.$rm->rm_code ] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>



                    </tr>
            @endforeach
</table>

                <td><a href="{{url('/production/recipe/'.$recipe->id.'/update')}}" class="btn btn-info">Update Home</a>

        </div>

@stop