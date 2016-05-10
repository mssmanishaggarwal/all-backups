@extends('layouts.dashboard')
@section('script')
  <script type="text/javascript">
     $(document).on('submit', '#post_reply', function(event) {
            event.preventDefault();
            var values = {};
            $.each($('#post_reply').serializeArray(), function(i, field) {
                  values[field.name] = field.value;
            });


          if(event.type=='submit'){
			$('.btnloader').show();
            $.ajax({
              url:baseUrl+"/dashboard/single/sent-reply",
              type: "POST",
              data: values,
              success: function(result) {
               // $.parseJSON(re.responseText);
               $('.btnloader').hide();
               var reslt=$.parseJSON(result);
             $('.sub-contact').html('<div class="alert alert-success orange"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>'+reslt.success+'</strong></div>');             
             setTimeout(function() { location.reload();}, 500);
           }
       }).error(function(re){
       			$('.btnloader').hide();
                var returnable=$.parseJSON(re.responseText);
                var count=1;



       });
     /* }else{*/

     /* }*/
     }
        });


</script>
@endsection
@section('content')

<section class="dash-main clearfix">

	<div class="col-md-12 dash-top-second">
		<div class="col-md-6">
			<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_44')}}</h2>
			<ul>
				<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
				<li><a href="{{ url('/dashboard/enquiries') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_44')}}</a></li>
				<li><?php echo (getHallName($data['heading_msg'][0]->hall_id)[0]->hall_name) ?>	</li>
			</ul>
		</div>
	</div>
	<?php
//echo '<pre>';
//print_r($data['heading_msg']);
//echo '</pre>';
?>
<div class="col-md-12 dash-container p-t-20 p-b-20">
	<div class="message-view">
<h3><?php echo (getHallName($data['heading_msg'][0]->hall_id)[0]->hall_name) ?></h3>
<p class="text-muted"><i class="ion-chatbox-working"></i> by
<strong><?php echo (getUserName($data['heading_msg'][0]->from_user_id)[0]->first_name) ?>
		<?php echo (getUserName($data['heading_msg'][0]->from_user_id)[0]->last_name) ?>
</strong>
 [<a href="<?php echo (getUserName($data['heading_msg'][0]->from_user_id)[0]->email) ?>">
 <?php echo (getUserName($data['heading_msg'][0]->from_user_id)[0]->email) ?></a>]
 <span class="fa fa-angle-double-right"></span>
  {{date('d M, Y h:m a',strtotime($data['heading_msg'][0]->msg_datetime)) }}</p>
<p class="text-orange"><?php echo ($data['heading_msg'][0]->message) ?></p>

<!-- Message reply Strat-->
<?php foreach (getReplyListing($data['heading_msg'][0]->msg_id) as $key => $value) {
//	echo 'from=' . $value->from_user_id;
	//	echo 'to=' . $value->to_user_id?>
<div class="message-view sub m-b-20">
<input type="hidden" name="last_from_id" id="last_from_id" value="<?php echo $value->from_user_id; ?>">
<h4><span class="ion-reply"></span> Re: <?php echo (getHallName($value->hall_id)[0]->hall_name) ?></h4>
<p class="text-muted">
<i class="ion-chatbox-working"></i>
by <strong><?php echo (getUserName($value->from_user_id)[0]->first_name) ?>
<?php echo (getUserName($value->from_user_id)[0]->last_name) ?></strong>
[<a href="<?php echo (getUserName($value->from_user_id)[0]->email) ?>"><?php echo (getUserName($value->from_user_id)[0]->email) ?></a>]
<span class="fa fa-angle-double-right"></span>
{{date('d M, Y h:m a',strtotime($value->msgreply_datetime)) }}
</p>
<p><?php echo $value->message; ?></p>
</div>
<?php if (Auth::user()->id == $data['heading_msg'][0]->from_user_id) {?>
<?php make_read($value->msg_id, $data['heading_msg'][0]->to_user_id);?>
<?php } else {?>
<?php make_read($value->msg_id, $data['heading_msg'][0]->from_user_id);?>
<?php }?>
<?php }?>
<!-- Message reply End-->
 <!-- <div class="message-view sub">
      <h4><span class="ion-reply"></span> Re: Test Advertisement - 1</h4>
	 <em>Code: #RTBBFF2521</em>
      <p class="text-muted"><i class="ion-chatbox-working"></i> by <strong>Palash Roy</strong> [<a href="mailto:palash@gmail.com">palash@gmail.com</a>] <span class="fa fa-angle-double-right"></span> Fri Mar 18, 2016 07:03 am</p>
      <p>What a sunny morning!</p></div> -->

<!-- Message reply End-->
<div class="message-view sub">
<label><i class="ion-chatbox-working"></i> {{ Sitevariable::setVariables($data['language_val'],'eventus_112')}}</label>
     	<form name="post_reply" id="post_reply" method="POST">
			<div class="sub-contact"></div>
			<input type="hidden" name="msg_parent_id" id="msg_parent_id" value="<?php echo $data['heading_msg'][0]->msg_id ?>">
			<input type="hidden" name="hall_id" id="hall_id" value="<?php echo $data['heading_msg'][0]->hall_id ?>">
      <?php if (Auth::user()->id == $data['heading_msg'][0]->from_user_id) {?>
			<input type="hidden" name="to_user_id" id="to_user_id" value="<?php echo $data['heading_msg'][0]->to_user_id ?>">
      <?php } else {?>
      <input type="hidden" name="to_user_id" id="to_user_id" value="<?php echo $data['heading_msg'][0]->from_user_id ?>">
      <?php }?>
          	<textarea name="message" id="message" class="form-control" rows="7" required=""></textarea>
          	<br>
        	<div class="text-right"><button id="postreplybtn" type="submit" class="btn btn-warning btn-flat orange" >{{ Sitevariable::setVariables($data['language_val'],'eventus_113')}}</button>
        	<span class="btnloader">{{ Html::image('public/images/site/orange-loader.gif','loader') }}</span>
        	</div>
   		</form>
    </div>
</div>

</div>

</section>
<style type="text/css">

</style>
@endsection