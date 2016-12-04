@extends('layouts.app')

@section('content')
<style type="text/css">
table tr {
    
    background-color: #ffffff;
   
}
}

table th {
 
    background-color: #ffffff;
    
}


table td {
     
    background-color: #ffffff;
    
}


</style>
 <body>     
 
 <div class="panel-body">

<table style="width:100%" class="table" >
  <tr>
    <th>RIGHT ID</th>
    <th>PAGE ID</th> 
    <th>PAGE NAME</th>
    <th>URL</th>
    
  </tr>
  @foreach($allrights as $allright)
  <tr>
    <td>{{$allright->id}}</td>
    <td>{{$allright->page_id}}</td>
    <td>{{$allright->page_name}}</td>
    <td>{{$allright->url}}</td>
    
    
  </tr>
@endforeach
</div>

</div>
</div>
</div>
</div>
</body>

