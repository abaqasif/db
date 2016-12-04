

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Update Recipe</h1>
        <h3>  Recipe ID :{{$id1}}</h3>
        <h3> Raw Material ID:{{$id2}}</h3>


         {{--Form::open(['method' => 'PATCH','url' => ['production/recipe/'.$id1.'/rm/'.$id2 ]])--}}

        {!! Form::model($req, [
          'method' => 'PATCH',
          'route' => ['rm.update', $id1, $id2]
      ]) !!}

        {{--{!! Form::label('Recipe:'.$req->recipe_id , ['class' => 'control-label']) !!}--}}
        {{--{!! Form::label('Raw_material:'.$req->rm_id , ['class' => 'control-label']) !!}--}}

        <div class="form-group">
            {!! Form::label('qty', 'QUANTITY:', ['class' => 'control-label']) !!}
            {!! Form::text('qty',$req[0]->qty, ['class' => 'form-control']) !!}
        </div>



        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>
@endsection

