@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>Update Recipe</h1>


                        <h4> ID: {{$recipe->id}}</h4>
                        <h4>BRAND: {{$recipe->brand}}</h4>
                        <h4>TYPE: {{$recipe->type}}</h4>
                        <h4>SHADE: {{$recipe->shade}}</h4>
                        <h4>UOM: {{$recipe->UOM}}</h4>
                        <h4>TYPE_ID: {{$recipe->type_id}}</h4>
                        <h4>BATCH_SIZE: {{$recipe->batchsize}}</h4>




                        <a href="/production/recipe/{{$recipe->id}}/edit" class="btn btn-info">Update Recipe</a>

                      <a href="{{url( 'production/recipe/'.$recipe->id.'/rm' ) }}"  class="btn btn-info">Update Raw Materials</a>
                       <a href="{{url('production/recipe/'.$recipe->id.'/rm/create')}}" class="btn btn-info">Add Raw Material</a>






    </div>
@stop