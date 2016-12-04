<html>
<head>

<title></title>

<style type="text/css">
 div.c1 {text-align: center}
</style>
</head>
<body>
<br>
<br>
@extends('layouts.master_layout')
@section('content')
<div class="container row col-md-8 col-md-offset-2 panel panel-default c2">
<div class="panel-heading c1">
<h3>Edit Raw Materials</h3>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="{{url('/edit_raw_material')}}">{{ csrf_field() }}

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


<div class="form-group{{ $errors->has('rm_id') ? ' has-error' : '' }}"><label for="rm_id" class="col-md-4 control-label">Name</label>
<div class="col-md-6">
<select id='rm_id' name="rm_id" class="form-control" autofocus required>
@foreach($rms as $rm)
<option value="{{$rm->id}}">{{$rm->name}}</option>
@endforeach
</select>
</div>
</div>


<!-- <div class="form-group{{ $errors->has('pack_size') ? ' has-error' : '' }}"><label for="pack_size" class="col-md-4 control-label">Pack Size</label>
<div class="col-md-6"><input id="pack_size" type="text" value="{{old ('pack_size')}}" class="form-control" name="pack_size"></div>
</div>
<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}"><label for="name"  class="col-md-4 control-label">Type</label>
<div class="col-md-6"><input id="type" style="text-transform:uppercase" value="{{old ('type')}}" type="text" class="form-control" name="type"></div>
</div>
<div class="form-group{{ $errors->has('uom') ? ' has-error' : '' }}"><label for="uom" class="col-md-4 control-label">UOM</label>
<div class="col-md-6"><select id="uom" class="form-control"  value="{{old ('uom')}}" name="uom" >
<option value="Kg.">Kg.</option>
<option value="No.">No.</option>
<option value="Liter">Liter</option>
<option value="Drum">Drum</option>
<option value="KG">Gallon</option>
<option value="KG">Quarter</option>
</select></div>
</div> -->
<div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}"><label for="rate"  class="col-md-4 control-label">Rate</label>
<div class="col-md-6"><input id="rate" style="text-transform:uppercase" value="{{old('rate')}}" type="number" class="form-control" name="rate"></div>
</div>
<<!-- div class="form-group{{ $errors->has('op_inv') ? ' has-error' : '' }}"><label for="op_inv" class="col-md-4 control-label">Opening Inventory</label>
<div class="col-md-6"><input id="op_inv" type="number" value="{{old ('op_inv')}}" class="form-control" name="op_inv"></div>
</div> -->
<div class="form-group{{ $errors->has('supp_id') ? ' has-error' : '' }}"><label for="op_inv" class="col-md-4 control-label">Supplier</label>
<div class="col-md-6"><select id="supp_id" value="{{old ('supp_id')}}" class="form-control" name="supp_id" autofocus required>
@foreach($allsuppliers as $allsupplier)
<option value="{{$allsupplier->id}}">{{$allsupplier->name}}</option>
@endforeach
</select></div>
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

<script type="text/javascript">


 document.getElementById('rm_id').addEventListener('input', function () {
 $value=document.getElementById('rm_id').value;

 $.ajax({

  type: 'get',
  url: '{{URL::to('rm_supp')}}' ,
  data: {'rm_id' : $value } ,

  success:function(data)

  {
    if(data.no!=="")
    { 
     document.getElementById('supp_id').innerHTML=data;

   }
   

 }});



$.ajax({

  type: 'get',
  url: '{{URL::to('rm_rate')}}' ,
  data: {'rm_id' : $value } ,

  success:function(data)

  {
    if(data.no!=="")
    { 
     document.getElementById('rate').innerHTML=data;

   }
   

 }});


});




</script>
</html>
@endsection