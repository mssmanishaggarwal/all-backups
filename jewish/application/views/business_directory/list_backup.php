<script>console.log('view/business_directory/list_backup.php');</script>
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/business.css">
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/review.css">
<script type="text/javascript">
    $(document).ready(function () {
        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
    });
	
</script>
<div class="container">
 <article class="page-content">
  <ul class="page-nav">
    <li><a href="<?php echo JEWISH_URL;?>">homepage></a></li>
    <li><a href="<?php echo JEWISH_URL;?>/business_directory/">Business Directory</a></li>
    <li>><a href="<?php echo JEWISH_URL;?>/business_directory/business_list/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>"><?php echo urldecode($this->uri->segment(3));?></a></li>
  </ul>

<style>
.star-rating{
	float:right;
}
</style>
<?php $city=$this->session->all_userdata( 'city_id');?>
<div class="add_b"><a href="<?php echo JEWISH_URL;?>/business_directory/add_business/">Add Your Business</a></div>
<div style="clear:both;"></div>
<div id="verticalTab">
            <ul class="resp-tabs-list">
            <?php $ar=$this->businessmod->get_businessname_bycat($this->allencode->decode($this->uri->segment(4)),$city['city_id'][0]);
			foreach ($ar as $v){?>
                <li><?php echo $v['b_name'] ?></li>
             <?php } ?>
                                                                          
            </ul>
            <div class="resp-tabs-container">
            <?php $art=$this->businessmod->get_businessprofile_bycat($this->allencode->decode($this->uri->segment(4)),$city['city_id'][0]);
			if(isset($art)&& !empty($art)){
			$count=1;
			foreach ($art as $p){?>
                <div>
            <?php $img=$this->businessmod->get_bd_image($p['id']); //print_r($img);
			if(empty($img) ){?>   
             <figure class="thum"><img src="<?php echo JEWISH_URL;?>/images/not-available.png" height="82" width="101" alt=""></figure>
             <?php }else {?>
              <figure class="thum"><img src="<?php echo JEWISH_URL;?>/upload/<?php echo $img[0]['img'];?>" height="82" width="101"  alt=""></figure>
             <?php } ?>
              <article class="content-right">
               <h3>
             <?php 
			 $actual_link=JEWISH_URL.'/business_directory/review/'.$this->allencode->encode($p['id']);
			 $user_log=$this->session->userdata('logged_in'); 
			 if(isset($user_log['user_id']) && !empty($user_log['user_id'])){
				 if($this->businessmod->check_commnet($user_log['user_id'],$p['id'])==0){?>
               <a href="" spl="<?php echo $count;?>" postcat="BD" title="Private Message" id="pvt_msg_but" ><img src="<?php echo JEWISH_URL;?>/images/msg.png" class="p_msg"/></a>
               <?php }else{ ?>
               <a href="" spl="<?php echo $count;?>" postcat="BD" title="You have already sent a message to this advertiser,Check My Account" onclick="return false;"><img src="<?php echo JEWISH_URL;?>/images/msg.png" class="p_msg_off"/></a>
               <?php } ?>
               <a href="<?php echo JEWISH_URL;?>/business_directory/review/<?php echo $this->allencode->encode($p['id']); ?>/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>">Write a review</a>
             <?php }else{ ?>
             <a href="<?php echo JEWISH_URL;?>/login/redirect/?redirect=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>"  title="Log in to create Private Message"><img src="<?php echo JEWISH_URL;?>/images/msg.png" class="p_msg"/></a>
             	<a href="<?php echo JEWISH_URL;?>/login/redirect/?redirect=<?php echo $actual_link; ?>">Write a review</a>
             <?php } ?>
               </h3>
               <h2><?php echo $p['b_name'] ?>
               <a href="" class="tooltip">
               <span>
                <span style="float:left;"><?php echo $this->businessmod->get_review_count($p['id'])?>&nbsp;reviews</span><ul class="star-rating">
                <?php $get_rev=$this->businessmod->get_avg_ratings($p['id']);
				/*echo '<pre>';
                 print_r($get_rev);
                echo '</pre>';*/
				?>
                   <li class="one-rating" id="current-rating" style="width:<?php echo $get_rev*25.25;?>px;"></li>
               </ul>
               </span>
                   <span class="els">
                        <strong>Rating Details</strong><br />
                        
                        <div style="width: 55px !important;position: absolute;	margin: 0;
	padding: 0;">
                        <span style="margin-top:5px;color:#3c3b3b;">1 Star</span>
                        <span style="margin-top:10px;color:#3c3b3b;">2 Star</span>
                        <span style="margin-top:13px;color:#3c3b3b;">3 Star</span>
                        <span style="margin-top:14px;color:#3c3b3b;">4 Star</span>
                        <span style="margin-top:14px;color:#3c3b3b;">5 Star</span>
                        </div>
                       
                <ul class="graph" style="margin-left: 60px !important;">
                   <li class="percent_1_<?php echo $p['id'];?>" style="height:17px;"><span><?php echo $this->businessmod->get_single_star($p['id'],1);?></span>&nbsp;</li>
                   <li class="percent_2_<?php echo $p['id'];?>" style="height:17px;"><span><?php echo $this->businessmod->get_single_star($p['id'],2);?></span>&nbsp;</li>
                  <li class="percent_3_<?php echo $p['id'];?>" style="height:17px;"><span><?php echo $this->businessmod->get_single_star($p['id'],3);?></span>&nbsp;</li>
                  <li class="percent_4_<?php echo $p['id'];?>" style="height:17px;"><span><?php echo $this->businessmod->get_single_star($p['id'],4);?></span>&nbsp;</li>
                  <li class="percent_5_<?php echo $p['id'];?>" style="height:17px;"><span><?php echo $this->businessmod->get_single_star($p['id'],5);?></span>&nbsp;</li>
                </ul>
                    </span>
                    <style>
					<?php for($i=1;$i<=5;$i++){?>
					         ul.graph li.percent_<?php echo $i;?>_<?php echo $p['id'];?>
							{
								 background: #600 ;
								 width:<?php echo $this->businessmod->get_bar_width($p['id'],$i);?>% !important;
							}
					<?php } ?>
                    </style>
               </a>
               </h2>
               <p class="viewspace"><?php echo $p['b_des'] ?></p>
               <div class="single-block-top-right">
                      <h2 class="addr">Address</h2>
                      <p><?php echo $p['b_address1'];?></p>
                      <p><?php echo $p['b_address2'];?></p>
                      <p><?php echo $this->citymod->fetch_single_city($p['b_city']);?></p>
                      <p><?php echo $p['b_state'];?></p>
                      <p><?php echo $p['b_zipcode'];?></p>
                      <p><?php echo $p['b_url'];?></p>
                     <span><?php echo $p['b_phone'];?></span>
                     <span></span>
              </div>
              <div style="clear:both;" id="msp_<?php echo $count;?>" class="alert_msg"></div>
             
              <div class="private_msg_<?php echo $count;?>" id="private_msgy" style="display:none;"> <h2>Message to Advertiser</h2>
              <form method="post" id="prvt_msgf_<?php echo $count;?>" >
              <textarea name="message" class="pmsg" id="msgbox_<?php echo $count;?>" required="required"></textarea>
              <input type="hidden" name="post_id" value="<?php echo $this->allencode->encode($p['id'])?>"/>
              <input type="hidden" name="poster_id" value="<?php echo $this->allencode->encode($this->businessmod->get_poster_postid($p['id'],'bd_add_business','b_email'));?>"/>
              <input type="hidden" name="post_type" value="BD"/>
              <input type="submit" name="b_submit" value="Submit" id="b_submity">
              </form>
                </div>
              </article>
                </div>
                
              <?php $count++;}
			}else{
				echo '<div class="alert">Business Profile for this category not yet listed</div>';
			}
	
			?>
               
            </div>
        </div>
        <?php
			/*$user_log=$this->session->userdata('logged_in');
			echo '<pre>';
			 print_r($user_log);	
			echo '</pre>';
			$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			echo $actual_link; */
		?>
 <div class="clear"></div>
 </article>
</div>
<script>
$(document).ready(function() {

 $('.content-right > h3 > #pvt_msg_but').click(function(kaushik){
	   kaushik.preventDefault();
	   var idd=$(this).attr('spl');
  $('.private_msg_'+idd).slideToggle(500);
   $('#prvt_msgf_'+idd).submit(function(biswa){ //alert('.private_msgf_'+idd);
	   biswa.preventDefault();
	   var other_data = $(this).serialize(); 
	   	$.ajax({
                      url: '<?php echo JEWISH_URL;?>'+'/business_directory/bd_private_message/?'+other_data,
                      type: 'POST',
                      success: function(data){
		                    		if(data=='success'){
										$('.private_msg_'+idd).hide('fast');
										$('#msp_'+idd).html("Your message has sent to advertiser, check My Account for advertiser's reply.");
										$('#msgbox_'+idd).val(' ');	
									}else if(data=='have_comment'){
										$('.private_msg_'+idd).hide('fast');
										$('#msp_'+idd).html("Your have made a comment to this advertiser, check My Account .");
										$('#msgbox_'+idd).val(' ');										
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

