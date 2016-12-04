
@extends('layouts.master_layout')

@section('menu')
@foreach($allpages as $allpage)
<li><a href="{{url('/{{$allpage->url}}')}}">{{$allpage->name}}</li>
@endforeach
@endsection
@section('content')

<br>
<br>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Delete Page</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/delete_page') }}">
                        {{ csrf_field() }}
                           @if(count($errors)>0)

                        <div class="row">

                        <div class="col-md-6">


                        <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach

                        
                        </ul>
                        </div>

                        </div>
                          @endif




                          <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            <label for="id" class="col-md-4 control-label">Page ID</label>

                            <div class="col-md-6">
                                <SELECT id="id" type="text" class="form-control" name="id" >

                                @foreach($allpages as $pages)
                                <option value="{{$pages->id}}">{{$pages->name}}</option>
                                @endforeach

                                </SELECT>
                                 </div>
                        </div>

                        

                             <div class="form-group" align="right">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Delete
                                </button>

                            </body>

                            @endsection