@extends('layouts.master_layout')
 @section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

 <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>

               


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="x_panel">
                <div class="panel-heading"><h3>PAYMENTS</h3></div>
                <div class="panel-body">
                     <div id ="warn" class="alert alert-danger alert-dismissible fade in" role="alert" style="visibility:hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>PLEASE ENTER DATA IN ALL THE REQUIRED FIELDS!</strong> 
                  </div>

@foreach($output as $out)
<hr>
<h4><span ><strong>SUPPLIER NAME :</strong> {{$out->supp_name}}</span>
<br>
<span ><strong>PURCHASE RECEIPT ID :</strong> {{$out->id}}</span>
<br>
<span><strong>OUTSTANDING AMOUNT :</strong> 
    @if($out->outstanding!=null)
    {{$out->outstanding}} 
    @endif
   @if($out->outstanding==null)
    {{$out->tot}} 
    @endif

</span></h4>



<hr>
<div class="form-group{{ $errors->has('check_no') ? ' has-error' : '' }}"><label for="check_no" class="col-md-4 control-label">CHEQUE NUMBER*</label>
<div class="col-md-6"><input id="check_no" type="text" value="{{old ('check_no')}}" class="form-control" name="check_no" autofocus required></input></div>
</div>
<div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}"><label for="remarks"  class="col-md-4 control-label">REMARKS</label>
<div class="col-md-6"><input id="remarks" style="text-transform:uppercase" value="{{old ('remarks')}}" type="text" class="form-control" name="remarks" autofocus required></input></div>
</div>
<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}"><label for="rate"  class="col-md-4 control-label">DATE*</label>
<div class="col-md-6"><input id="date" style="text-transform:uppercase" value="{{old ('date')}}" type="date" class="form-control" name="date" autofocus required></input></div>
</div>
<div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}"><label for="op_inv" class="col-md-4 control-label">AMOUNT*</label>
<div class="col-md-6"><input id="total" type="number" value="{{old ('total')}}" class="form-control" name="total" autofocus required></input></div>
</div>




<div class="form-group" align="right">
<div class="col-md-8 col-md-offset-4">


<button type="button" class="btn btn-primary" onclick="create({{$out->id}},{{$out->supp_id}})">Save</button>

@endforeach
</div>
</div>







                </div>
                 </div>
                 </div>
                 </div>
                 </div>




<script type="text/javascript">


function create(pr_id,supp_id){





var check_no=document.getElementById('check_no').value;
var remarks=document.getElementById('remarks').value;

if(remarks==null){remarks="no remarks";}

var date=document.getElementById('date').value;
var total=document.getElementById('total').value;

/*
if((check_no==null)||(remarks==null)||(date==null)||(total!=null)){ 
  document.getElementById('warn').style.visibility="visible";}
    else{*/
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 $.ajax({

    type: 'POST',

    url: '{{URL::to('post_create_payments')}}' ,
    data: {
     
    'supp_id' : supp_id,
    'pr_id' : pr_id,
    'check_no' : check_no,
    'remarks' : remarks,
    'date' : date ,
    'total' : total ,
     } ,

    success:function(data)

    {
    
     console.log(data);
    window.location='{{url('/view_purchase_receipt')}}';

}});

/*}*/



}

</script>


@endsection