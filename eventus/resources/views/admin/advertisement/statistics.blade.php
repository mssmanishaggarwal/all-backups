@extends('layouts.backend')
@section('content')
<input  type="hidden" name="linkUrl" id="linkUrl" value="{{$data['module_ajaxurl']}}" />
<div id="main">
<div class="box search-box">
<div class="box-header with-border">
                  <h3 class="box-title">Search Filters <span id="spinner-loader-search" style="display: none;">
                                    {{ Html::image('public/images/loader.gif') }}
                                </span></h3>
                  <div class="box-tools pull-right">
                    <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-angle-up"></i></button>
                  </div>
                </div>
                <div class="box-body">
				  <form name="searchfrm" id="searchfrm" method="POST" action="{{$data['module_ajaxurl']}}" class="form-horizontal">
               <div class="form-group">
			 
               <div class="col-sm-4"> 
                    <input type='text' id='Search_from_date' class="form-control" placeholder="From" name="Search_from_date" value="{{isset($data['Search_from_date'])?$data['Search_from_date']:''}}" />
					
                  </div>
                  
                  <div class="col-sm-4"> 
                    <input type='text' id='Search_to_date' class="form-control" placeholder="To" name="Search_to_date" value="{{isset($data['Search_to_date'])?$data['Search_to_date']:''}}" />
					
                  </div>
                  
                    <div class="col-sm-3"> 
                     <button type="submit" class="btn btn-primary btn-flat"> Go <span class="fa fa-angle-double-right"></span></button> 
					 <button type="button" onclick="document.location.href='{{ url('/admin/advertisement_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Back</button>
                  </div>
				 
                  </div>
                </form>

                </div>
				
                 
                </div>
             
             <div class="box box-default" id="recordset">   
            <div class="box box-warning">

            <div class="box-header with-border">
                  <h3 class="box-title"> {{ $data['subHeading'] }}</h3>                  
                </div>
                <div class="box-body">
					<div class="form-group">
		               <label class="col-sm-2 text-right"> Total Impression: </label>
                       <div class="col-sm-4">
					   		<strong>{{$data['total_impression']}}</strong>
					   </div>
					</div>
					
					<div class="form-group">
		               <label class="col-sm-2 text-right"> Total Views: </label>
                       <div class="col-sm-4">
					   		<strong>{{$data['total_click']}}</strong>
					   </div>
					</div>  					
            	</div>
        
          <div id="curve_chart" style="width: 100%; height: 500px"></div>  
               
           
		</div>
                        
        </div>
        </div>
@endsection
@section('script')
    {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
<script>
$(function () {	
    $("#Search_from_date").datepicker({        
		dateFormat: "dd/mm/yy",
		maxDate: "+0D",
		onSelect: function (selected) {
           var dt = new Date(selected);
           var fromDate = (dt.getMonth()+1)+"/"+dt.getDate()+"/"+dt.getFullYear();
           var toDate = $("#Search_to_date").val();
           if(fromDate != '' && toDate != ''){
		   		if(new Date(fromDate)>new Date(toDate)){
					$("#Search_from_date").val('');
				}
		   }
        }
    });
    $("#Search_to_date").datepicker({       
		dateFormat: "dd/mm/yy",
		maxDate: "+0D",
        onSelect: function (selected) {
           var dt = new Date(selected);
           var toDate = (dt.getMonth()+1)+"/"+dt.getDate()+"/"+dt.getFullYear();
           var fromDate = $("#Search_from_date").val();
           if(fromDate != '' && toDate != ''){
		   		if(new Date(fromDate)>new Date(toDate)){
					$("#Search_to_date").val('');
				}
		   }         
        }
    });

	
}); 
</script>   
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {      	
      	var x = <?php echo trim($data['impression_stats']) ?>;
      
        var data = google.visualization.arrayToDataTable(x);

        var options = {
          title: 'Statistics',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
</script>
@endsection