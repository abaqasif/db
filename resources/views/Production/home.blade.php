@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>Production Home</h1>

        <hr>
        <a href="{{ route('batch.index') }}" class="btn btn-info">Batch Form</a>
        <a href="{{  route('recipe.index') }}" class="btn btn-info">Recipe Form</a>
        <a href="{{ route('wastage.index') }}" class="btn btn-info">Wastages</a>
        <a href="{{ url('production/item') }}" class="btn btn-info">Item</a>


    </div>
    <div class="container">
        <h1>Reports</h1>

        <hr>
        <a href="{{ url('production/dpr') }}" class="btn btn-info">Daily Production Report</a>
        <a href="{{ url('production/mixing_paper/select_batch') }}" class="btn btn-info">Mixing Report (Without Cost)</a>
        <a href="{{ url('production/mixing_cost/select_batch') }}" class="btn btn-info">Mixing Report (With Cost)</a>

    </div>
@stop