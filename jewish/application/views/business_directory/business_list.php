<script>console.log('view/business_directory/business_list.php');</script>
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
    <li>><a href="<?php echo JEWISH_URL;?>/business_directory/business_list/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>/1"><?php echo urldecode($this->uri->segment(3));?></a></li>
  </ul>
  <?php $city=$this->session->all_userdata( 'city_id');?>
  <div class="add_b"><a href="<?php echo JEWISH_URL;?>/business_directory/add_business/">Add Your Business</a></div>
  <div class="business_title"><?php echo ucwords(urldecode($this->uri->segment(3))).', '.$this->citymod->fetch_single_city($city['city_id'][0]);?></div>
<?php 
		$url=$this->uri->segment(5);
	    $page = isset($url) ? $url : 1;
		$recordsPerPage = 4;
		$fromRecordNum = ($recordsPerPage * $page) - $recordsPerPage;
?>
<?php $query=$this->businessmod->get_businessprofile_bycat($this->allencode->decode($this->uri->segment(4)),
                                                                                              $city['city_id'][0],
																							  $recordsPerPage,
																							  $fromRecordNum);
		   $art=$query->result_array();
		   $num=$query->num_rows(); 																	  
			if($num>0){
				foreach ($art as $p){?>
<section class="single-description-wrap clearfix">
      <section class="single-description-block clearfix">
        <section class="single-description-block-top clearfix">
        <?php /*$img=$this->businessmod->get_bd_image($p['id']); //print_r($img);
			if(empty($img) ){?>   
          <div class="single-block-top-image"><img src="<?php echo JEWISH_URL;?>/images/not-available.png" height="110" width="120" alt=""></div>
          <?php }else {?>
          <div class="single-block-top-image"><img src="<?php echo JEWISH_URL;?>/upload/<?php echo $img[0]['img'];?>" height="110" width="120"  alt=""></div>
          <?php } */?>
          <div class="single-block-top-middle">
            <div class="single-block-top-middle-name">
            <a href="<?php echo JEWISH_URL;?>/business_directory/businessprofile/<?php echo $this->uri->segment(3);?>/<?php echo urlencode($p['b_name']); ?>/<?php echo $this->uri->segment(4);?>/<?php echo $this->allencode->encode($p['id'])?>">
			<?php echo $p['b_name'] ?>
            </a>
            </div>
            <p class="viewspacer"><?php echo substr(strip_tags($p['b_des']),0,220) ?>
            <span><a href="<?php echo JEWISH_URL;?>/business_directory/businessprofile/<?php echo $this->uri->segment(3);?>/<?php echo urlencode($p['b_name']); ?>/<?php echo $this->uri->segment(4);?>/<?php echo $this->allencode->encode($p['id'])?>">Read More</a></span>
            </p>
            <!--<div class="single-block-top-middle-desig">Contractors</div>-->
          </div>
          <div class="single-block-top-right">
                            <p style="font-weight:bold;"><?php echo $p['b_address1'];?></p>
                      <p><?php echo $p['b_address2'];?></p>
                      <p><?php echo $this->citymod->fetch_single_city($p['b_city']).', '.$p['b_state'].' , '.$p['b_zipcode'];?></p>
                     <span><?php echo $p['b_phone'];?></span>
          </div>
        </section>
        
      </section>
      
      
      
      
    </section>
    <?php
				}
				
				/*==============Pagination Second Part===============*/
		echo "<div id='paging'>";
		if($page>1){
			echo "<a href='". JEWISH_URL .'/business_directory/business_list/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/1'."' title='Go to the first page.' class='customBtn'>";
			echo "<span style='margin:0 .5em;'> << </span>";
			echo "</a>";
			
			$prev_page = $page - 1;
			echo "<a href='". JEWISH_URL .'/business_directory/business_list/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$prev_page."' title='Previous page is {$prev_page}.' class='customBtn'>";
			echo "<span style='margin:0 .5em;'> < </span>";
			echo "</a>";
			
		}
		$total_rows=$this->businessmod->get_businessprofile_totalrow($this->allencode->decode($this->uri->segment(4)),
                                                                                              $city['city_id'][0]);
		$total_pages = ceil($total_rows / $recordsPerPage);
		$range = 2;
		$initial_num = $page - $range;
		$condition_limit_num = ($page + $range)  + 1;

		for ($x=$initial_num; $x<$condition_limit_num; $x++) {
			if (($x > 0) && ($x <= $total_pages)) {
				if ($x == $page) {
					echo "<span class='customBtn' style='background:none;color:black;'>$x</span>";
				} 
				else {
					echo " <a href='". JEWISH_URL .'/business_directory/business_list/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$x."' class='customBtn'>$x</a> ";
					
				}//$y=$x;
			}
			//=$x;
		}
		$y=ceil($total_rows/$recordsPerPage);
		if($page<$total_pages){
			$next_page = $page + 1;
		echo "<a href='". JEWISH_URL .'/business_directory/business_list/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$next_page."' title='Next page is {$next_page}.' class='customBtn'>";
		echo "<span style='margin:0 .5em;'> > </span>";
		echo "</a>";
		echo "<a href='". JEWISH_URL .'/business_directory/business_list/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$total_pages."' title='Last page is {$total_pages}.' class='customBtn'>";
		echo "<span style='margin:0 .5em;'> >> </span>";
		echo "</a>";
		}
		echo '<div class="goto goto-list">';
		echo "<form action='". JEWISH_URL .'/business_directory/business_list/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'."' method='POST' id='pagi'>";
		echo "Go to page: ";
		if(!isset($y)){ $y=1;}
		echo "<input type='number' name='page' size='1' id='pag' min='1' max='".$y."' required='required'/>";
		echo "<input type='submit' value='Go' class='customBt' />";
	    echo "</form>";							
	    echo '</div>';	
	    echo "</div>";
				/*==============Pagination Second Part Ended===============*/
					 }else{
								echo '<div class="alert">Business Profile for this category or pagenumber not yet listed</div>';
								echo "<a href='". JEWISH_URL .'/business_directory/business_list/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/1'."' title='Go to the first page.' class='customBtn'>";
				echo "<span style='margin:0 .5em;'>Go to First page</span>";
			echo "</a>";
							} 
					
        					
							?>
 </article>
</div>
<script>
$(document).ready(function() {
	$('#pagi').submit(function(biswa){
		var act=$(this).attr('action');
		var tgt=$('#pag').val();
		$(this).attr('action',act+tgt);
		});

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


