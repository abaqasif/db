@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Recipe Form</h1>

        <hr>

        <a href="{{ route('recipe.create') }}" class="btn btn-info">Add Recipe</a>
        <a href="{{url('/production/recipe/update')}}" class="btn btn-info">Update Recipe</a>
        <a href="{{url('/production/recipe/delete')}}" class="btn btn-info">Delete Recipe</a>
        <a href="{{ route('recipe.index') }}" class="btn btn-info">All Recipes</a>


    </div>
@stop