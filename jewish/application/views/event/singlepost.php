<script>console.log('view/event/singlepost.php');</script>
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/addpost.css"> 

 

<script>

        history.forward();

		$(document).ready(function($) {

            $(".thumb > img").mouseenter(function(){

				var img_url=$(this).attr('src');

				$(".big_image > img").attr('src', img_url);

				})

        });

				function go_back(){

		history.back(1);

		}

</script>

<div class="container"> 

<article class="page-content">

  <ul class="page-nav">

    <li><a href="<?php echo JEWISH_URL;?>">Homepage</a></li>

    <li> > <a href="" onclick="go_back();">Back to Listing</a></li>

  </ul>  

 <section class="body" >

 <div class="posting">

  <?php //echo $id;?>  

    

<form method="">

  <?php 

  

$query = $this->db->query("SELECT * FROM post WHERE id='".$id."'");

foreach ($query->result_array() as $row){

	?>

    

    

    <div class="post_title"><?php  echo $row['post_title']?><?php echo '( '.$this->citymod->fetch_single_city($row['geo_area']).' )'?><?php echo '( '.$row['contact_phone'].' )'?></div>

    <br/>

       <?php 

	$this->db->select('*');

				   $this->db->where('post_id', $id );

				   $query = $this->db->get('images');

				   $data = $query->result_array();

				   //print_r($data);

				   ?>

   <?php if(empty($data) ){?>

   <div class="big_image"><img src="<?php echo JEWISH_URL;?>/images/not-available.png" height="350" width="500"/></div>

  <?php }else{ ?>                 

	        <?php $q= $this->db->query("SELECT * FROM images WHERE post_id='".$id."' LIMIT 0,1");  

			 

                foreach ($q->result_array() as $img){ 

             // print_r($q);

?>

    <div class="big_image"><img src="<?php echo JEWISH_URL;?>/upload/<?php echo $img['img'];?>" height="350" width="500"/></div>

    

<?php	} 

  }?>

    <div class="meta_data">





<table width="" border="0" cellspacing="0" class="gradienttable">

 <tr>

    <td><p>Event Advertisement</p></td>

    <td><p><?php  if($this->postmod->get_post_meta_event($id,'event_advertisement')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_advertisement');}?></p></td>

  </tr>

   <tr>

    <td><p>Art/film</p></td>

    <td><p><?php  if($this->postmod->get_post_meta_event($id,'event_art')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_art');}?></p></td>

  </tr>

  <tr>

    <td><p>Career</p></td>

    <td><p> <?php if($this->postmod->get_post_meta_event($id,'event_career')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_career');}?></p></td>

  </tr>

  <tr>

    <td><p>Charitable</p></td>

    <td><p><?php  if($this->postmod->get_post_meta_event($id,'event_charitable')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_charitable');}?></p></td>

  </tr>

  <tr>

    <td><p>Competition</p></td>

    <td><p><?php if($this->postmod->get_post_meta_event($id,'event_competition')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_competition');}?></p></td>

  </tr>

  <tr>

    <td><p>Dance</p></td>

    <td><p><?php if($this->postmod->get_post_meta_event($id,'event_dance')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_dance');}

	?></p></td>

  </tr>

  <tr>

    <td><p>Fest/fair</p></td>

    <td><p><?php if($this->postmod->get_post_meta_event($id,'event_festival')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_festival');}?></p></td>

  </tr>

  <tr>

    <td><p>Fitness/health</p></td>

    <td><p><?php if($this->postmod->get_post_meta_event($id,'event_fitness_wellness')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_fitness_wellness');}?></p></td>

  </tr>

  <tr>

    <td><p>Food/drink</p></td>

    <td><p><?php if($this->postmod->get_post_meta_event($id,'event_food')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_food');}?></p></td>

  </tr>

 <tr>

    <td><p>Free</p></td>

    <td><p><?php if($this->postmod->get_post_meta_event($id,'event_free')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_free');}?></p></td>

  </tr>

  <tr>

    <td><p>Kid friendly</p></td>

    <td><p><?php if($this->postmod->get_post_meta_event($id,'event_kidfriendly')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_kidfriendly');}?></p></td>

  </tr>

   <tr>

    <td><p>Literary</p></td>

    <td><p><?php if($this->postmod->get_post_meta_event($id,'event_literary')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_literary');}?></p></td>

  </tr>

   <tr>

    <td><p>Music</p></td>

    <td><p><?php if($this->postmod->get_post_meta_event($id,'event_music')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_music');}?></p></td>

  </tr>

  <tr>

    <td><p>Outdoor</p></td>

    <td><p><?php if($this->postmod->get_post_meta_event($id,'event_outdoor')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_outdoor');}?></p></td>

  </tr>

    <tr>

    <td><p>Sale</p></td>

    <td><p><?php if($this->postmod->get_post_meta_event($id,'event_sale')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_sale');}?></p></td>

  </tr>

  <tr>

    <td><p>Singles</p></td>

    <td><p><?php if($this->postmod->get_post_meta_event($id,'event_singles')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_singles');}?></p></td>

  </tr>

  <tr>

    <td><p>Tech</p></td>

    <td><p><?php if($this->postmod->get_post_meta_event($id,'event_geek')=='yes'){ echo $this->postmod->get_post_meta_event($id,'event_geek');}?></p></td>

  </tr>

</table>

    </div>

    <div style="clear:both;"></div>

    <div class="thumb">

<?php $q= $this->db->query("SELECT * FROM images WHERE post_id='".$id."'");  

foreach ($q->result_array() as $img){ ?>

     <img src="<?php echo JEWISH_URL;?>/upload/<?php echo $img['img'];?>" height="50" width="50" class="images"/>

 <?php } ?>  

 	</div>  

     <div style="clear:both;"></div>

     <div class="post_content"><h2>Event Date & Duration</h2>

     <table width="" border="0" cellspacing="0" class="gradienttable">

     <tr>

     <td><p>Event Date</p></td>

     <td><p><?php echo $this->postmod->get_post_meta_event($id,'start_date')?> / 

     <?php echo $this->postmod->get_post_meta_event($id,'start_month')?></p></td>

     </tr>

       <tr>

     <td><p>Event Duration</p></td>

     <td><p><?php echo $this->postmod->get_post_meta_event($id,'event_duration').' &nbsp;Day(s) ';?></p></td>

     </tr>

     </table>

     </div>

     <div class="post_content"><h2>Description</h2><?php echo $row['post_content']?></div>

 <?php } ?> 

  

</form>  

  <?php 

			// $actual_link=JEWISH_URL.'/business_directory/review/'.$this->allencode->encode($p['id']);

			 $user_log=$this->session->userdata('logged_in'); 

			 if(isset($user_log['user_id']) && !empty($user_log['user_id'])){

				 if($this->businessmod->check_commnet($user_log['user_id'],$row['id'])==0){?>

               <a href="" spl="" postcat="CL" title="Private Message" id="pvt_msg_but" >

               <input type="submit" value="Message to Advertiser" name="submtadd"></a>

               <?php }else{ ?>

               <a href="" spl="" postcat="CL" title="You have already sent a message to this advertiser,Check My Account" onclick="return false;">

               <input type="submit" value="Message to Advertiser" name="submtadd" class="p_msg_off"></a>

               <?php } ?>

             <?php }else{ ?>

             <a href="<?php echo JEWISH_URL;?>/login/redirect/?redirect=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>"  title="Log in to create Private Message"><input type="submit" value="Message to Advertiser" name="submtadd" class=""></a>

             <?php } ?>

             <p id="msp"></p> 

             <div class="private_msg" id="private_msgy" style="display:none;"> <h2>Message to Advertiser</h2>

              <form method="post" id="prvt_msgf" >

              <textarea name="message" class="pmsg" id="msgbox" required="required"></textarea>

              <input type="hidden" name="post_id" value="<?php echo $this->allencode->encode($row['id'])?>"/>

              <input type="hidden" name="poster_id" value="<?php echo $this->allencode->encode($this->businessmod->get_poster_postid($row['id'],'post','c_email'));?>"/>

              <input type="hidden" name="post_type" value="CL"/>

              <input type="submit" name="b_submit" value="Submit" id="b_submity">

              </form>

                </div>   

</div>

</section>

</article>

</div>

<script>

$(document).ready(function() {



 $('#pvt_msg_but').click(function(kaushik){

	   kaushik.preventDefault();

  $('.private_msg').slideToggle(500);

   $('#prvt_msgf').submit(function(biswa){ //alert('.private_msgf_'+idd);

	   biswa.preventDefault();

	   var other_data = $(this).serialize(); 

	   	$.ajax({

                      url: '<?php echo JEWISH_URL;?>'+'/business_directory/classified_private_message/?'+other_data,

                      type: 'POST',

                      success: function(data){

		                    		if(data=='success'){

										$('.private_msg').hide('fast');

										$('#msp').html("Your message has sent to advertiser, check My Account for advertiser's reply.");

										$('#msgbox').val(' ');	

									}else if(data=='have_comment'){

										$('.private_msg').hide('fast');

										$('#msp').html("Your have made a comment to this advertiser, check My Account .");

										$('#msgbox').val(' ');										

									}

                             }

                  });

	 });

 }) ;

	$('.p_msg_off').on('click',function(){

		alert('You have already sent a message to this advertiser,Check My Account');

		});

});

</script>

