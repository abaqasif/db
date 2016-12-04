

<html>
<head>

<title></title>

<style type="text/css">
 div.c1 {text-align: center}
</style>
</head>
<body>
@extends('layouts.master_layout')
     @section('content')
<style type="text/css">
 div.c1 {text-align: left}
</style>
</head>
<body>

<br>
<br>
<div class="panel panel-default">
<div class="panel-heading c1">
<center><h3>Create Suppliers</h3></center>
</div>
<div class="panel-body" >
<form class="form-horizontal" method="post" action="{{url('/edit_suppliers')}}">{{ csrf_field() }}

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


<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"><label for="name" class="col-md-4 control-label">Name</label>
<div class="col-md-6"><input id="name" type="text" style="text-transform:uppercase"  class="form-control" name="name"  value="{{old ('name')}}" autofocus required></div>
</div>
<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}"><label for="address" class="col-md-4 control-label">Address</label>
<div class="col-md-6"><input id="address" type="text" style="text-transform:uppercase"  class="form-control" name="address" value="{{old ('address')}}" autofocus required></div>
</div>
<div class="form-group{{ $errors->has('owner_name') ? ' has-error' : '' }}"><label for="op_inv" class="col-md-4 control-label">Owner Name</label>
<div class="col-md-6"><input id="owner_name" type="text" style="text-transform:uppercase"  class="form-control" name="owner_name"></div>
</div>
<div class="form-group{{ $errors->has('owner_number') ? ' has-error' : '' }}"><label for="owner_number" class="col-md-4 control-label">Owner Number</label>
<div class="col-md-6"><input id="owner_number" type="text" class="form-control" name="owner_number" value="{{old ('owner_number')}}"></div>
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"><label for="supp_id" class="col-md-4 control-label">Email</label>
<div class="col-md-6"><input id="email" type="email" style="text-transform:lowercase"  class="form-control"  value="{{old ('email')}}" name="email"></div>
</div>
<div class="form-group{{ $errors->has('payment_term') ? ' has-error' : '' }}"><label for="payment_term" class="col-md-4 control-label">Payment Term</label>
<div class="col-md-6"><input id="payment_term" type="number" class="form-control" name="payment_term" value="{{old ('payment_term')}}" autofocus required></div>
</div>
<div class="form-group{{ $errors->has('credit_limit') ? ' has-error' : '' }}"><label for="credit_limit" class="col-md-4 control-label">Credit Limit</label>
<div class="col-md-6"><input id="credit_limit" type="number" class="form-control" name="credit_limit" value="{{old ('credit_limit')}}"></div>
</div>
<div class="form-group{{ $errors->has('web_add') ? ' has-error' : '' }}"><label for="web_add" class="col-md-4 control-label">Web Address</label>
<div class="col-md-6"><input id="web_add" type="text" class="form-control" style="text-transform:lowercase" value="{{old ('web_add')}}" name="web_add"></div>
</div>



<hr>
<div class="form-group{{ $errors->has('contact_person') ? ' has-error' : '' }}"><label for="contact_person" class="col-md-4 control-label">Contact Person</label>
<div class="col-md-6"><input id="contact_person"  style="text-transform:uppercase" type="text" class="form-control" value="{{old ('contact_person')}}" name="contact_person" autofocus required></div>
</div>
<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}"><label for="address" class="col-md-4 control-label">Phone Number</label>
<div class="col-md-6"><input id="phone_number" type="text" class="form-control" name="phone_number" value="{{old ('phone_number')}}" autofocus required></div>
</div>
<div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}"><label for="address" class="col-md-4 control-label">Mobile Number</label>
<div class="col-md-6"><input id="mobile_number" type="text" class="form-control" value="{{old ('mobile_number')}}" name="mobile_number"></div>
</div>
<div class="form-group" align="right">
<div class="col-md-8 col-md-offset-4">
<button type="submit" class="btn btn-primary">Save</button>
</div>
</div>
</form>
</div>
</div>

</body>
</html>
@endsection