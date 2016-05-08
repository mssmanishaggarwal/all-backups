<script>console.log('view/business_directory/single_business.php');</script>
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/business.css">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js"></script>
<div class="container">
 <div class="m-description-wrap clearfix">
   <div class="m-description-top clearfix">
     <span><a href="<?php echo JEWISH_URL;?>">Homepage</a></span> > 
     <span><a href="<?php echo JEWISH_URL;?>/business_directory/">Business Directory</a></span> >
     <span><a href="<?php echo JEWISH_URL;?>/business_directory/business_list/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(5);?>/1"><?php echo urldecode($this->uri->segment(3));?></a></span> >
     <span><a href="<?php echo JEWISH_URL;?>/business_directory/businessprofile/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>/<?php echo $this->uri->segment(5);?>/<?php echo $this->uri->segment(6);?>"><?php echo urldecode($this->uri->segment(4));?></a></span>
   </div>
   <script>
   $(document).ready(function(e) {
$('.m-carousel-inner').slick({
  lazyLoad: 'ondemand',
  slidesToShow: 4,
  slidesToScroll: 1
});
/*$('.m-carousel-image > a').mouseenter(function(e){
	var counter=$(this).attr('counter');
	$('.slick-active.dib_'+counter).css({'width':'220px','height':'170px'});
	//$(this).attr('height','250');
	//$(this).attr('width','295');
	});
$('.m-carousel-image > a').mouseleave(function(){
	var counter=$(this).attr('counter');
	$('.slick-active.dib_'+counter).css({'width':'','height':''});
	//$(this).attr('height','165');
	//$(this).attr('width','225');
	});*/
});

   
   </script>
<?php $fetch=$this->businessmod->get_singlebd_byid($this->allencode->decode($this->uri->segment(6))); //print_r($fetch);?>   
   <div class="m-add-business clearfix">
     <div class="m-add-business-left">
       
       <?php $img=$this->businessmod->get_bd_image($this->allencode->decode($this->uri->segment(6)));
	   if(empty($img) ){?>
<div class="m-add-business-left-image"><img src="<?php echo JEWISH_URL;?>/images/m-carousel-img-4.jpg" height="75" width="76" ></div>
       <?php }else { ?>
<div class="m-add-business-left-image"><img src="<?php echo JEWISH_URL;?>/upload/<?php echo $img[0]['img'];?>" height="75" width="76"  alt=""></div>
       <?php } ?>
       
       <div class="m-add-business-left-text">
         <h3><?php echo $fetch[0]['b_name'];?></h3>
         <h4><?php echo $fetch[0]['b_address1'];?> ,<?php echo $fetch[0]['b_address2'];?> , <?php echo $fetch[0]['b_state'];?></h4>
       </div>
     </div>
     <div class="m-add-business-right"><a href="<?php echo JEWISH_URL;?>/business_directory/add_business/">Add your Business</a></div>
   </div>
   
   
   
   <div class="m-carousel-wrap clearfix">
    <div class="m-carousel-inner clearfix">
    <?php $ft_im=$this->businessmod->get_bd_image($fetch[0]['id']); //echo '<pre>'; //print_r($img);echo '</pre>';
	$image_count=count($ft_im);
	$count=1;
	foreach($ft_im as $imgs=>$im){?>
<div class="m-carousel-image dib_<?php echo $count;?>"><a href="" counter="<?php echo $count;?>"><img src="<?php echo JEWISH_URL;?>/upload/<?php echo $im['img']?>" width="225" height="165" alt="" title=""></a></div>
      <?php $count++;} ?>
      <?php if($image_count==0){?>
      <div class="m-carousel-image"><a href="" counter="0"><img src="<?php echo JEWISH_URL;?>/images/m-carousel-img-4.jpg" alt="" title=""></a></div>
      <?php } ?>
    </div>
   </div>
   
   
   <div class="m-description-main-wrap clearfix">
     <div class="m-description-main-inner clearfix">
       <div class="m-description-main-left">
           <div class="m-description-main-left-con">
           <h3 class="m-text"><?php echo $fetch[0]['b_address1'];?> ,<?php echo $fetch[0]['b_address2'];?> , <?php echo $fetch[0]['b_state'];?>,</br>
           <?php echo $this->citymod->fetch_single_city($fetch[0]['b_city'])?>
           - <?php echo $fetch[0]['b_zipcode']?></h3>
           <h3 class="m-phn"><?php echo $fetch[0]['b_phone'];?></h3>
           <?php
           	 //$actual_link=JEWISH_URL.'/business_directory/review/'.$this->allencode->encode($fetch[0]['id']);
			 $user_log=$this->session->userdata('logged_in'); 
			 if(isset($user_log['user_id']) && !empty($user_log['user_id'])){?>
           <h3 class="m-mail"><a href="#" id="pvt_msg_but">Message this business</a></h3>
           <?php }else {?>
           <h3 class="m-mail"><a href="<?php echo JEWISH_URL;?>/login/redirect/?redirect=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="">Message this business</a></h3>
           <?php }?>
        <!--Private message-->
           <div class="private_msg" id="private_msgy" style="display:none;"> <!--<h2>Message to Advertiser</h2>-->
              <form method="post" id="prvt_msgf" >
              <textarea name="message" class="pmsg" id="msgbox" required="required"></textarea>
              <input type="hidden" name="post_id" value="<?php echo $this->allencode->encode($fetch[0]['id'])?>"/>
              <input type="hidden" name="poster_id" value="<?php echo $this->allencode->encode($this->businessmod->get_poster_postid($fetch[0]['id'],'bd_add_business','b_email'));?>"/>
              <input type="hidden" name="post_type" value="BD"/>
              <input type="submit" name="b_submit" value="Submit" id="b_submity">
              </form>
                </div>
                <p id="msp"></p>
        <!--Private message-->
         </div>
       </div>
       <div class="m-description-main-right">
         <?php echo $fetch[0]['b_des'];?>
         
         <div class="m-description-main-right-btn-wrap clearfix">
           <div class="m-description-main-right-btn"><a href="<?php echo JEWISH_URL;?>/myaccount/business_profilelist/">Edit Your Businss</a></div>
         </div>
         
       </div>
     </div>
   </div>
 </div>
 
</div>
<style>
.m-description-main-right > ol, .m-description-main-right > ul {
  list-style:inside;
}
.m-description-main-right > h1{
	font-size:24px;
}
.m-description-main-right > h2{
	font-size:20px;
}
.m-description-main-right > h3{
	font-size:18px;
}
</style>
<script>
$(document).ready(function() {

 $('#pvt_msg_but').click(function(kaushik){
	   kaushik.preventDefault();
	   $('#msp').html("");
  $('.private_msg').slideToggle(500);
   $('#prvt_msgf').submit(function(biswa){ //alert('.private_msgf_'+idd);
	   biswa.preventDefault();
	   var other_data = $(this).serialize(); 
	   	$.ajax({
                      url: '<?php echo JEWISH_URL;?>'+'/business_directory/bd_private_message/?'+other_data,
                      type: 'POST',
                      success: function(data){
		                    		if(data=='success'){
										$('.private_msg').hide('fast');
										$('#msp').html("Your message has sent to advertiser, check My Account for advertiser's reply.");
										$('#msgbox').val(' ');	
									}else if(data=='have_comment'){
										$('.private_msg').hide('fast');
										$('#msp').html("Your have already made a message to this advertiser, check My Account .");
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