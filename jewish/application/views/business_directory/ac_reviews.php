<script>console.log('view/business_directory/ac_reviews.php');</script>
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/business.css">
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/review.css">
<style>
.forums-post ul li {
  overflow: hidden;
  padding: 0px 0 0px;
  margin: 0px 0 0;
}
.forums-post ul li:hover{
	overflow:none;
}
.page-content {
  background: #fff;
  border: 1px solid #ccccc8;
  padding: 0 25px 16px;
  font-family: 'SegoeUIRegular';
}
#review {
  margin-top: 4px;
}
.forums-post ul {
  margin-bottom: -24px;
}
#b_des {
  width: 96% !important;
  margin-left: 1.5% !important;
  margin-top: 20px;
}
</style>
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

/*function rateImg(rating,imgId)  {
		var remote = new xhr, rating, nt;
		//nt = remote.send('update.php?rating='+rating+'&imgId='+imgId );
		rating = (rating * 25) - 1;//alert(rating);
		document.getElementById('current-rating').style.width = rating+'px';
		//document.getElementById('ratingtext').innerHTML = 'Thank you for your rating!';
}*/
/*$(document).ready(function() {
    $(".star-rating_1 > li > a").on('click',function(){
		$("#imgId").val($(this).attr('name'));
		});
	$("#review").submit(function(kaushik){
		if($("#imgId").val()==''){
			kaushik.preventDefault();
			$("#selrate").html("Please cust your star rating");
		}
		});
});*/
</script>
<div class="container">
 <article class="page-content">
   <ul class="page-nav">
    <li><a href="<?php echo JEWISH_URL;?>/myaccount/">My Account</a></li>
    <li> > <a href="<?php echo JEWISH_URL;?>/myaccount/business_reviews/">Your Reviews</a></li>
  </ul>
  <p></p>
<section class="forums-post">
 <h3>Your Reviews</h3>
 <div class="message_wrapper">
 <?php $user_log=$this->session->userdata('logged_in'); 
 $vl=$this->businessmod->get_all_review_byuser($user_log['user_id']);
 if(isset($vl[0]['post_id'])){
 $count=1;
 foreach( $vl as $val ){?>
 <script>
 function rateImg_<?php echo $count;?>(rating,imgId)  {
		var remote = new xhr, rating, nt;
		rating = (rating * 25) - 1;//alert(rating);
		document.getElementById('current-rating_<?php echo $count;?>').style.width = rating+'px';
}
$(document).ready(function() {
    $("#star-rating_<?php echo $count;?> > li > a").on('click',function(){
		$("#imgId_<?php echo $count;?>").val($(this).attr('name')); //alert();
		});
	$(".update_<?php echo $count;?>").submit(function(kaushik){
		if($("#imgId_<?php echo $count;?>").val()==''){
			kaushik.preventDefault();
			$("#selrate_<?php echo $count;?>").html("Please cust your star rating");
		}
		});
});
 </script>
 <div class="list_reviews"><h2><?php echo $this->businessmod->get_postname_by_postid($val['post_id']);?></h2>
            
<?php /*?><ul class="star-rating"><li class="one-rating" id="current-rating" style="width:<?php echo $val['imgId']*24;?>px;"></li></ul><?php */?>
 <form id="review" class="update_<?php echo $count;?>" action="<?php echo JEWISH_URL;?>/business_directory/update_review/" method="post">
 
   	<label for="email" id="b_des_lebel">Update Your Ratings</label> <span id="selrate_<?php echo $count;?>" style="color:red;"></span>
    <ul class="star-rating"><li class="one-rating" id="current-rating" style="width:<?php echo $val['imgId']*24;?>px;"></li></ul>
    <ul class="star-rating" id="star-rating_<?php echo $count;?>">
    <li class="current-rating" id="current-rating_<?php echo $count;?>" style=""></li>
    	<li><a href="javascript:rateImg_<?php echo $count;?>(1,1)" title="1 star out of 5" class="one-star" name="1">1</a></li>
        <li><a href="javascript:rateImg_<?php echo $count;?>(2,2)" title="2 stars out of 5" class="two-stars" name="2">2</a></li>
        <li><a href="javascript:rateImg_<?php echo $count;?>(3,3)" title="3 stars out of 5" class="three-stars" name="3">3</a></li>
        <li><a href="javascript:rateImg_<?php echo $count;?>(4,4)" title="4 stars out of 5" class="four-stars" name="4">4</a></li>
        <li><a href="javascript:rateImg_<?php echo $count;?>(5,5)" title="5 stars out of 5" class="five-stars" name="5">5</a></li>
    </ul>
<?php /*?><ul class="star-rating">
           <li class="one-rating" id="current-rating" style="width:<?php echo $val['imgId']*24;?>px;"></li>
           </ul><?php */?>
    
    <input type="hidden" name="imgId" id="imgId_<?php echo $count;?>" value=""/>
    <input type="hidden" name="post_id" id="post_id" value="<?php echo $this->allencode->encode($val['post_id']);?>"/>
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->allencode->encode($user_log['user_id']);?>"/>
    <label for="email" id="b_des_lebel">Your Review</label>
    <textarea name="b_des" rows="5" cols="50" id="b_des"><?php echo $val['comment']?></textarea>
    <input type="submit" name="b_submit_<?php echo $count;?>" value="Submit" id="b_submit"/>
 </form> 
 </div>
<?php  $count++;} 
 }else{
	 echo '<h2>You have not create any review to any Business Profile</h2>';
 }?>
 <div style="clear:both;"></div>
 </div>
 </section>
</article>
</div>
<style>
  font-family: 'SegoeUIRegular';
  font-size: 13px;
  color: #3c3b3b;
  padding: 10px 0 0px;
  line-height: 22px;
  </style>