@extends('layouts.dashboard')
@section('script')
<script type="text/javascript">
	$(document).on('click','.cross',function(){
      if(confirm('Do you want to Remove this hall from favourite list?')){
      var dal_id=$(this).data('delete-id');
      var returna={
        id:dal_id
      }
      $.ajax({
      url: baseUrl+"/dashboard/fav/delete",
      data:returna,
      type: "POST",
      dataType: "application/json",

    }).error(function(err){
      var get=$.parseJSON(err.responseText);
      if(get.status=='success'){
       // $('.alert-success').show('fast');
        $('.li_del_'+dal_id).remove();
      }
    });
  }
});
</script>
@endsection
@section('content')
<section class="dash-main clearfix">
	<div class="col-md-12 dash-top-second">
		<div class="col-md-9">
			<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_42')}}</h2>
			<ul>
				<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
				<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_42')}}</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 dash-container my-favourite p-t-20 p-b-20">
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

		<?php if (array_key_exists('my_favourite', $data)) {
	foreach ($data['my_favourite'] as $key => $val) {
		?>
			<div class="col-md-3 col-sm-6 col-xs-6 m-b-15 li_del_<?php echo $val->id; ?>">
				
					<div class="hallbox clearfix favourite">
					<span class="cross" data-delete-id="<?php echo $val->id; ?>">x</span>
						<a href="<?php echo $val->hall_url; ?>">
							<div class="hallbox-photo">
								<img src="{{ url('/public/uploads/hall') }}/<?php echo $val->hall_image; ?>" width="275" height="150" alt="Hall image">

								<span class="price"><?php echo setCurrency($val->rental_amount); ?> </span>

							</div>
						</a>
						<div class="hallbox-info">
							<a href="<?php echo $val->hall_url; ?>">
								<h4><?php echo $val->hall_name; ?></h4>
								<div class="halllocation">
									<p><?php echo $val->location_name; ?>, <?php echo $val->province_name; ?></p>
								</div>



							</a>

						</div>

					</div>
				
			</div>
			<?php
}
}?>

	</div>


</section>

@endsection