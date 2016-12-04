@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>All Recipes</h1>
        <p class="lead">Here's a list of all your Recipes:</p>

        <div class = "container">
            <table class="table table-condensed" style="width:90%">
                <tr>
                    <th>ID</th>
                    <th>BRAND</th>
                    <th>TYPE</th>
                    <th>SHADE</th>
                    <th>UOM</th>
                    <th>ACTIVE</th>
                    <th>TYPE_ID</th>
                    <th>BATCHSIZE</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach(App\Recipe::all() as $recipe)
                    <tr>

                        <td>{{$recipe->id}}</td>
                        <td>{{$recipe->brand}}</td>
                        <td>{{$recipe->type}}</td>
                        <td>{{$recipe->shade}}</td>
                        <td>{{$recipe->UOM}}</td>
                        <td>{{$recipe->active}}</td>
                        <td>{{$recipe->type_id}}</td>
                        <td>{{$recipe->batchsize}}</td>




                        <td>
                            {!! Form::open(['method' => 'DELETE','route' => ['recipe.destroy', $recipe->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete Recipe', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>

                    </tr>
            @endforeach
        </div>
        <hr>





    </div>
@stop