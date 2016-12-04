
@extends('layouts.master_layout')

@section('content')

<br>
<br>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Edit Page</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/edit_page') }}">
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

<!-- 

                          <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            <label for="id" class="col-md-4 control-label">Page ID</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control" name="id" required autofocus>
                                 </div>
                        </div> -->

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label"  >Edit Page</label>

                           <!--  <div class="col-md-6">
                                <input id="name" type="text" class="form-control" style="text-transform:uppercase" name="name" >
                                 </div>
                        </div> -->
                        <div class="col-md-6" >
                        <select id="id" name="id" class="form-control" autofocus required  onchange="details()">


                        <option value=""></option>
                        @foreach($allpages as $page)
                        <option value="{{$page->id}}">{{$page->name}}</option>
                        @endforeach


                        </select>
                    </div>
<br>
<br>
<br>
                         <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label  class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" style="text-transform:uppercase" class="form-control" name="name" autofocus required >
                                 </div>
                        </div>

                         <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">URL</label>

                            <div class="col-md-6">
                                <input id="url" type="text" class="form-control" name="url" autofocus required >
                                 </div>
                        </div>

                        <span id="ap"></span>

                             <div class="form-group" align="right">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>

                            </body>

                            @endsection



                            <script type="text/javascript">




function details(){

    var page_id=document.getElementById('id').value;


 $.ajax({

  type: 'get',
  url: '{{URL::to('page_details')}}' ,
  data: {'page_id': page_id } ,

  success:function(data)

  {

    //alert(data[0].p_name);
    

document.getElementById('name').value=data[0].p_name;
document.getElementById('url').value=data[0].p_url;


   
   

 }});

}


                            </script>