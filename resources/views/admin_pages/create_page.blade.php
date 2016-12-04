
@extends('layouts.master_layout')


@section('content')




<br>
<br>
 
 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<!-- 
                <body>  -->
                <div class="panel-heading"><center><h3>Create New Page</h3></center></div>
                <div class="panel-body"> 
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/create_page') }}">



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





                    

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Page Name</label>

                            <label id="error"></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" style="text-transform:uppercase" onfocus="NAME_ON_FOCUS()" onblur="NAME_ON_BLUR()">
                                 </div>
                        </div>

                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">URL</label>

                            <div class="col-md-6">
                                <input id="url" type="text" class="form-control" name="url" >
                                 </div>
                        </div>

                             <div class="form-group" align="right">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                              </form>

                            <!-- </body> -->
                               @endsection

                          

                           