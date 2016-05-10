@extends('layouts.dashboard')
@section('script')
<script type="text/javascript">
	$(document).on('click','.cross',function(stop){
		if(!confirm('Do you want to delete this hall?')){
			stop.preventDefault();
		}
	});
</script>
@endsection
@section('content')
<section class="dash-main clearfix">
<div class="col-md-12 dash-top-second">
	<div class="col-md-12 p-l-none p-b-10">
	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_123')}}</h2>
	<ul>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_123')}}</li>
	</ul>
	</div>
</div>
<div class="col-md-12 dash-container p-t-20 p-b-20">
@if (session('status'))
<div class="alert alert-success orange">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{ session('status') }}</strong>
</div>
@endif
@if (session('fails'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{ session('fails') }}</strong>
</div>
@endif
<!-- add my hall link -->
<a href="{{ url('/dashboard/add-my-hall') }}"><button type="button" class="btn btn-default orange">{{ Sitevariable::setVariables($data['language_val'],'eventus_124')}}</button></a>
<div class="table-responsive">
	<h3>{{ Sitevariable::setVariables($data['language_val'],'eventus_125')}}</h3>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>{{ Sitevariable::setVariables($data['language_val'],'eventus_126')}}</th>
				<th>{{ Sitevariable::setVariables($data['language_val'],'eventus_127')}}</th>
				<th>{{ Sitevariable::setVariables($data['language_val'],'eventus_128')}}</th>
				<th>{{ Sitevariable::setVariables($data['language_val'],'eventus_66')}}</th>
				<th>{{ Sitevariable::setVariables($data['language_val'],'eventus_129')}}</th>
				<th>{{ Sitevariable::setVariables($data['language_val'],'eventus_130')}}</th>
			</tr>

		</thead>
		<tbody>
			<?php if (array_key_exists('hall_details', $data)) {
	foreach ($data['hall_details'] as $key => $value) {?>
				<tr>
				<td><a href="{{url('/')}}/hall/<?php echo base64_encode($value->id); ?>" ><?php echo $value->hall_name; ?></a>,<br>
					<p><?php echo $value->location_name; ?>,
					<?php echo $value->province_name; ?></p>
				</td>
				<td>
				@if(isset($value->subscription_name) && isset($value->expiry_date))
				<p><?php echo $value->subscription_name; ?></p>
				<p><?php echo 'Expiry: '.dateFormat($value->expiry_date); ?></p>
				@else
				<p>{{ Sitevariable::setVariables($data['language_val'],'eventus_131')}}</p> 
				<a href="{{url('/')}}/edit-subscription/{{$value->id}}" title="Buy Subscription"><button class="btn btn-default orange btn-xs" type="button">{{ Sitevariable::setVariables($data['language_val'],'eventus_132')}}</button></a>
				@endif
				</td>
				<td><?php foreach ($value->hall_type as $hl => $ht) {?>
				<?php echo $ht->hall_type_name; ?><br>
				<?php }?></td>
				<td><?php foreach ($value->accommodation as $hl => $ht) {?>
				<?php echo $ht->accommodation_name; ?> ( <?php echo $ht->accommodation_number; ?> ) <br>
				<?php }?></td>
				<td><?php foreach ($value->addon as $hl => $ht) {?>
				<?php echo $ht->addon_name; ?> ( <?php echo $ht->addon_price; ?> AOA ) <br>
				<?php }?></td>

					<td><div class="btn-toolbar">
							<a href="{{url('/')}}/edit-redirects/{{$value->id}}" title="Details"><button type="button" class="btn btn-primary btn-xs orange"><i class="fa fa-file-text-o"></i></button></a>
							<a href="{{url('/')}}/edit-photos/{{$value->id}}" title="Photos"><button type="button" class="btn btn-primary btn-xs orange"><i class="fa fa-image"></i></button></a>
							<a href="{{url('/')}}/edit-addons/{{$value->id}}" title="Addon"><button type="button" class="btn btn-primary btn-xs orange"><i class="fa fa-puzzle-piece"></i></button></a>
							<a href="{{url('/')}}/edit-accommodations/{{$value->id}}" title="Accommodation"><button type="button" class="btn btn-primary btn-xs orange"><i class="fa fa-building-o"></i></button></a>
							<a href="{{url('/')}}/edit-calendar/{{$value->id}}" title="Calender"><button type="button" class="btn btn-primary btn-xs orange"><i class="fa fa-calendar"></i></button></a>
							<a href="{{url('/')}}/edit-subscription/{{$value->id}}" title="Subscription"><button type="button" class="btn btn-primary btn-xs orange"><i class="fa fa-cube"></i></button></a>
							<a href="{{url('/')}}/delete-hall/{{$value->id}}" title="Delete"><button type="button" class="btn btn-primary btn-xs orange cross"><i class="fa fa-trash-o"></i></button></a>
					</div></td>
				</tr>
				<?php
}
}
?>
		</tbody>
	</table>
</div>
</div>


</section>

@endsection