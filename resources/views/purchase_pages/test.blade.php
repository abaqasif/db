
@extends('layouts.master_layout')
@section('content')


<script src="{{asset('assets/code/highcharts.js')}}"></script>


<div id="container" style="width:100%; height:400px;"></div>



<script type="text/javascript">


     var chart = Highcharts.chart('container', {

        title: {
            text: 'Chart.update'
        },

        subtitle: {
            text: 'Plain'
        },

        xAxis: {categories:["OSAKA","COLOURS CORP.","EDGE ENTERPRISE"]},

        series:  {!!json_encode($bg)!!} ,
           
        

    });


   
</script>
@endsection