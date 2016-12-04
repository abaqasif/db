
@extends('layouts.master_layout')

@section('content')
<br>
<br>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Edit Right</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/edit_right') }}">
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
                            <label for="name" class="col-md-4 control-label">User ID</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control" name="id" >
                                 </div>
                        </div>


                       <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="oldpage" class="col-md-4 control-label">Old Section</label>

                                     <div class="col-md-6">

                                      <select id="mypage" class="form-control" name="oldpage" autofocus required>

                               
                                  <option value="RAW MATERIALS">RAW MATERIALS</option>
                                    <option value="SUPPLIERS">SUPPLIERS</option>
                                    <option value="PURCHASE">PURCHASE</option>
                                    <option value="INVENTORY">INVENTORY</option>
                                    <option value="PRODUCTION">PROUDCTION</option>
                                 


                                 
                                    </select>
                                  
                                    </datalist>

                        
                                
                                 
                                 
                              
</div>
<br>
<br>



<div>



                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="newpage" class="col-md-4 control-label">New Section</label>

                                     <div class="col-md-6">

                                      <select id="mypage" class="form-control" name="newpage">

                               
                                  
                                    <option value="RAW MATERIALS">RAW MATERIALS</option>
                                    <option value="SUPPLIERS">SUPPLIERS</option>
                                    <option value="PURCHASE">PURCHASE</option>
                                    <option value="INVENTORY">INVENTORY</option>
                                    <option value="PRODUCTION">PROUDCTION</option>
                                 
                                    </select>
                                  
                                    </datalist>

                        
                                
                                 
                                 
                              
</div>


                        </div>
                        </div>

                             <div class="form-group" align="right">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>

                            </body>

                            @endsection