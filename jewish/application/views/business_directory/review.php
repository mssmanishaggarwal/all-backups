<script>console.log('view/business_directory/review.php');</script>
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/business.css">
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/review.css">
<div class="container">
 <article class="page-content">
  <ul class="page-nav">
    <li><a href="<?php echo JEWISH_URL;?>">homepage></a></li>
    <li><a href="<?php echo JEWISH_URL;?>/business_directory/">Business Directory</a></li>
    <li>>
    <a href="<?php echo JEWISH_URL;?>/business_directory/business_list/<?php echo $this->uri->segment(4);?>/
	<?php echo $this->uri->segment(5);?>">
	<?php echo $this->uri->segment(4);?></a></li>
    <li>><a href="<?php echo JEWISH_URL;?>/business_directory/review/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>/
	<?php echo $this->uri->segment(5);?>">Reviews</a></li>
  </ul>
  <div style="clear:both;"></div>
<section class="page-event">
<h1 class="add_heading">All reviews of 
 <?php $ar=$this->businessmod->get_businessname_byid($this->allencode->decode($this->uri->segment(3)));
			foreach ($ar as $v){ echo $v['b_name'];}?></h1>
  <?php
             $user_log=$this->session->userdata('logged_in');
			/*echo '<pre>';
			 print_r($user_log);	
			echo '</pre>';*/
			$get_user_com=$this->businessmod->check_review_by_user($user_log['user_id'],$this->allencode->decode($this->uri->segment(3)));
			if($get_user_com==0){
			?>
            
<div class="yform">


  <!--======-->
  <script>
/* request channel */
function xhr() {};
xhr.prototype.init = function() {
	try {
		this._xh = new XMLHttpRequest();
	} catch (e) {
		var _ie = new Array(
		'MSXML2.XMLHTTP.5.0',
		'MSXML2.XMLHTTP.4.0',
		'MSXML2.XMLHTTP.3.0',
		'MSXML2.XMLHTTP',
		'Microsoft.XMLHTTP'
		);
		var success = false;
		for (var i=0;i < _ie.length && !success; i++) {
			try {
				this._xh = new ActiveXObject(_ie[i]);
				success = true;
			} catch (e) {
				
			}
		}
		if ( !success ) {
			return false;
		}
		return true;
	}
}

xhr.prototype.wait = function() {
	state = this._xh.readyState;
	return (state && (state < 4));
}

xhr.prototype.process = function() {
	if (this._xh.readyState == 4 && this._xh.status == 200) {
		this.processed = true;
	}
}

xhr.prototype.send = function(urlget,data) {
	if (!this._xh) {
		this.init();
	}
	if (!this.wait()) {
		this._xh.open("GET",urlget,false);
		this._xh.send(data);
		if (this._xh.readyState == 4 && this._xh.status == 200) {
			return this._xh.responseText;
		}
	}
	return false;
}

function rateImg(rating,imgId)  {
		var remote = new xhr, rating, nt;
		//nt = remote.send('update.php?rating='+rating+'&imgId='+imgId );
		rating = (rating * 25) - 1;//alert(rating);
		document.getElementById('current-rating').style.width = rating+'px';
		//document.getElementById('ratingtext').innerHTML = 'Thank you for your rating!';
}
$(document).ready(function() {
    $(".star-rating > li > a").on('click',function(){
		$("#imgId").val($(this).attr('name'));
		});
	$("#review").submit(function(kaushik){
		if($("#imgId").val()==''){
			kaushik.preventDefault();
			$("#selrate").html("Please cust your star rating");
		}
		});
});
</script>
<?php $attributes = array('id' => 'review');
                   echo form_open_multipart('business_directory/add_review', $attributes);
				   ?>
  	<label for="email" id="b_des_lebel">Your Ratings</label> <span id="selrate" style="color:red;"></span>
    <ul class="star-rating">
    <li class="current-rating" id="current-rating" style=""></li>
    	<li><a href="javascript:rateImg(1,1)" title="1 star out of 5" class="one-star" name="1">1</a></li>
        <li><a href="javascript:rateImg(2,2)" title="2 stars out of 5" class="two-stars" name="2">2</a></li>
        <li><a href="javascript:rateImg(3,3)" title="3 stars out of 5" class="three-stars" name="3">3</a></li>
        <li><a href="javascript:rateImg(4,4)" title="4 stars out of 5" class="four-stars" name="4">4</a></li>
        <li><a href="javascript:rateImg(5,5)" title="5 stars out of 5" class="five-stars" name="5">5</a></li>
    </ul>

    
    <input type="hidden" name="imgId" id="imgId" value=""/>
    <input type="hidden" name="post_id" id="post_id" value="<?php echo $this->uri->segment(3);?>"/>
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_log['user_id'];?>"/>
    <label for="email" id="b_des_lebel">Your Review</label>
    <textarea name="b_des" rows="5" cols="50" id="b_des"></textarea>
    <input type="submit" name="b_submit" value="Submit" id="b_submit"/>
 </form> 
 </div> 
<?php }else{ ?> 
<div class="yform">
<h1 class="add_heading">You have already post a Review for this Bussiness Profile</h1>
</div>
<?php } ?>
<div class="reviewlist"> 

<?php $fetch=$this->businessmod->get_all_preview($this->allencode->decode($this->uri->segment(3)));
/* echo '<pre>';
 print_r($fetch);
 echo '</pre>';*/
 foreach($fetch as $k=>$v){
	 
 ?>
           <section class="single-description-block-bottom clearfix">
           <ul class="star-rating">
           <li class="one-rating" id="current-rating" style="width:<?php echo $v['imgId']*24;?>px;"></li>
           </ul>
           <?php 
		   $profile=$this->businessmod->get_user_picture($v['user_id']);
		   ?>
		   <h3 class="usernm"><?php echo ucfirst($profile[0]['username']);?></h3>
		  <?php   if(isset($profile[0]['user_image'])&&!empty($profile[0]['user_image'])){
		   ?>
          <div class="single-description-block-bottom-image"><img src="<?php echo JEWISH_URL;?>/<?php echo $profile[0]['user_image'];?>" height="100" alt="" title=""></div>
          <?php }else{ ?>
          <div class="single-description-block-bottom-image"><img src="<?php echo JEWISH_URL;?>/images/not-available.png" height="100" alt="" title=""></div>
          <?php } ?>
          <div class="single-description-block-bottom-para"><?php echo $v['comment'];?> </div>
          </section>
<?php } ?>      
</div>
</section>
 <div class="clear"></div>
 </article>
</div>