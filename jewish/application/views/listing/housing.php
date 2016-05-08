<script>console.log('view/listing/housing.php')</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
	    $(".list-g a").click(function(event) {
        event.preventDefault();
        $(this).addClass("current");
        $(this).siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).slideDown('slow');
   });
   $("#rst").click(function(){ 
	   $("#house_srch").get(0).reset();
	   window.location.href ="<?php echo JEWISH_URL;?>/classified/search/housing/";
	   });

	$('ul.suprman >li >a').on('click',function(e){ //alert(e.which+e.type);
	e.preventDefault();
	var count=$(this).attr('ids');
//alert();
	$.ajax({
                      url: '<?php echo JEWISH_URL;?>'+'/classified/get_children_r/?pot='+count,  
                      type: 'POST',
                      success: function(data){$('.sub_'+count).html(data);
						  		$('.sub_'+count).slideToggle(500); //alert(data);
						  		//
                             }
                  });
	
	});	
 });
</script>
<script type="text/javascript" src="<?php echo JEWISH_URL;?>/js/jquery.pajinate.js"></script>
<div class="container">
 <article class="page-content">
  <ul class="page-nav" id="vot">
    <li><a href="<?php echo JEWISH_URL;?>">Homepage></a></li>
    <li><a href="<?php echo JEWISH_URL;?>/classified/search/<?php echo $type?>/"><?php echo ucfirst($type)?></a></li>
    <li><a href="<?php //echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>"><?php //echo $this->postmod->get_single_catname($_GET['cat_id']);?></a></li>
  </ul>
  <div class="create_post"><a class="event-heading" href="<?php echo JEWISH_URL;?>/post/addhousingpost/<?php //echo $this->uri->segment(3)?>">create post</a></div>
    <?php /*if(isset($_REQUEST['cat_id']))
	{ 
	unset($cat_id);
	$cat_id=$_REQUEST['cat_id'];}*/
	
	//echo $cat_id;?>
    <?php 
	$this->db->select('post_id');
			if(isset($_GET['housing_wanted'])){
				$this->db->where('housing_wanted', $this->input->get("housing_wanted") );
				}
			if(isset($_GET['housing_offered'])){
				$this->db->where('housing_offered', $this->input->get("housing_offered") );
				}
			 if(isset($_GET['pets_cat'])){
				$this->db->where('pets_cat', $this->input->get("pets_cat") );
				}
			 if(isset($_GET['pets_dog'])){
				$this->db->where('pets_dog', $this->input->get("pets_dog") );
				 }
			if(isset($_GET['private_bath'])){
					$this->db->where('private_bath', $this->input->get("private_bath") );
				}
			 if(isset($_GET['private_room'])){
				 $this->db->where('private_room', $this->input->get("private_room") );
			 }
			 if(isset($_GET['no_smoking'])){
				   $this->db->where('no_smoking', $this->input->get("no_smoking") );
			   }
			 if(isset($_GET['wheelchaccess'])){
					$this->db->where('wheelchaccess', $this->input->get("wheelchaccess") );
				}
			$query=$this->db->order_by('id', 'DESC');	
		$query = $this->db->get('housing_post_meta');
	 
		$data = $query->result_array();
		
	//echo $this->db->last_query();
		$art=array();
		foreach( $data as $k=>$v){
			//print_r($v);
			//echo $this->hosing_loading_list($v['post_id']);
			array_push($art,$v['post_id']);
		}
		

		?>
 <script>
 function callit(){
	$('.event-right').pajinate({
					items_per_page : 3,
					item_container_id : '.gallery',
					nav_panel_id : '.alt_page_navigation_gallery'
					
				}); 
				//alert();
 }
$(document).ready(function(){
				$('.event-right').pajinate({
					items_per_page : 3,
					item_container_id : '.gallery',
					nav_panel_id : '.alt_page_navigation_gallery'
					
				});
				$('.event-right').pajinate({
					items_per_page : 3,
					item_container_id : '.list-v',
					nav_panel_id : '.alt_page_navigation'
					
				});
				/*$('.alt_page_navigation >a').on('click',function(){
					$('.alt_page_navigation_gallery >a').trigger('click');
					});
				$('.alt_page_navigation_gallery >a').on('click',function(){
					$('.alt_page_navigation >a').trigger('click');
					});*/ 	
				$(".galleryr").on('click',function(){
					$(".alt_page_navigation").hide();
					$(".alt_page_navigation_gallery").show();
					});
				$(".listr").on('click',function(){
					$(".alt_page_navigation").show();
					$(".alt_page_navigation_gallery").hide();					
					});
				$(".last_link").click(function(){ 
					$(".last").show();
					$( ".list-v > a" ).last().css( "display", "block" );
					$( ".gallery > a" ).last().css( "display", "block" );
				});	
			});	
</script>       
<section class="page-event">
<?php /*?> <h1><!--<a class="event-heading" href="#">account</a>-->
 <a class="event-heading" href="<?php echo JEWISH_URL;?>/post/type_post/<?php echo $this->uri->segment(3)?>">create post</a>
 <span>
 <!--<a href="#">Email alert</a>
 <a href="#">Save search</a>-->
 </span>
</h1><?php */?>

<aside class="side-bar-left">
<?php /*?><article class="check-area">
    		<h2>Housing Category</h2>
            <ul class="suprman">
            <?php $rec=$this->postmod->get_subcat('housing',true); foreach($rec as $vl){?>
 <li><a href="<?php echo JEWISH_URL;?>/classified/search/housing/?cat_id=<?php echo $vl['id'];?>" ids="<?php echo $vl['id'];?>">
 <?php echo ucwords($vl['category_name']);?></a></li>
 <ul class="sub_<?php echo $vl['id'];?>" id="subcatty" style="display:none;"></ul>
             <?php } ?>
            </ul>
</article><?php */?>
 <?php $attributes = array('id' => 'house_srch','method' => 'get');
            echo form_open_multipart('classified/search/housing/?', $attributes);
				   ?>
 <article class="check-area">
 <?php /*?><input type="hidden" name="cat_id" value="<?php echo $cat_id;?>" /><?php */?>
 <label>
 <label><input type="checkbox" name="housing_wanted" value="yes" <?php if(isset($_GET['housing_wanted'])){ echo 'checked';}?> onclick="this.form.submit();">Housing Wanted</label>
 <label><input type="checkbox" name="housing_offered" value="yes" <?php if(isset($_GET['housing_offered'])){ echo 'checked';}?> onclick="this.form.submit();">Housing Offered</label>
 <input type="checkbox" name="pets_cat" value="cats accepted" <?php if(isset($_GET['pets_cat'])){ echo 'checked';}?> onclick="this.form.submit();">
 cats Acceptable</label>
 <label><input type="checkbox" name="pets_dog" value="dogs accepted" <?php if(isset($_GET['pets_dog'])){ echo 'checked';}?> onclick="this.form.submit();">Dogs Acceptable</label>
 <label><input type="checkbox" name="private_bath" value="yes" <?php if(isset($_GET['private_bath'])){ echo 'checked';}?> onclick="this.form.submit();">Private Bath</label> 
 <label><input type="checkbox" name="private_room" value="yes" <?php if(isset($_GET['private_room'])){ echo 'checked';}?> onclick="this.form.submit();">Private Room</label>
  <label><input type="checkbox" name="no_smoking" value="yes" <?php if(isset($_GET['no_smoking'])){ echo 'checked';}?> onclick="this.form.submit();">No Smoking</label> 
  <label><input type="checkbox" name="wheelchaccess" value="yes" <?php if(isset($_GET['wheelchaccess'])){ echo 'checked';}?> onclick="this.form.submit();">Wheel Chair access</label>
  
 </article>
 <article class="check-area last" style="border:none;">
<input type="reset" value="reset" id="rst">
<input type="submit" value="search">
</article>
<?php echo form_close(); ?>
</aside>

<div class="event-right">
 <div class="list-g"><a class="current listr" href="#tab-1">list</a><a href="#tab-2" class="galleryr">gallery</a></div>
 <div class="pn-bt"><!--<a href="#"><<</a><a href="#"> < prev </a><a href="#">1 - 100 of 1153</a><a href="#">next ></a>-->
 <div class="alt_page_navigation"></div><div class="alt_page_navigation_gallery" style="display:none;"></div></div>
 <!--<div class="un-bt" style="width:68px;"><a href="#">newest</a></div>-->
 <div class="clear"></div>
<div id="tab-1" class="tab-content">
<ul class="list-v">
<?php 
$sz=sizeof($art);
for($i=0; $i<$sz; $i++){
	 $city=$this->session->all_userdata( 'city_id');
$q_m=$this->db->order_by('post_date', 'DESC')->get_where('post', array('id'=>$art[$i]/*,'object_id' => $cat_id*/,'status !=' => 0,'geo_area'=>$city['city_id'][0]));

 foreach($q_m->result_array() as $k=>$v){?>
<a href="<?php echo JEWISH_URL;?>/classified/single_housing/<?php echo $this->allencode->encode($v['id']);?>"><li><img src="<?php echo JEWISH_URL;?>/images/star1.png" alt=""><?php  $yrdata= strtotime($v['post_date']); echo date('jS F Y', $yrdata);?><strong><?php echo $v['post_title'];?></strong>
 -   ($<?php  echo $this->postmod->get_post_meta($v['id'],'ask')?>)-(<?php echo $this->postmod->get_post_meta($v['id'],'sqft')?>ft<sup>2</sup>)
 Area -<?php  echo  $this->citymod->fetch_single_city($v['geo_area']);?></li></a>
<?php } 
}?>


</ul>
</div>
<div id="tab-2" class="tab-content">
 <ul class="gallery">
 <?php 
 $sz=sizeof($art);
for($i=0; $i<$sz; $i++){
	 $city=$this->session->all_userdata( 'city_id');
 $q_m=$this->db->order_by('post_date', 'DESC')->get_where('post', array('id'=>$art[$i]/*,'object_id' => $cat_id*/,'status !=' => 0,'geo_area'=>$city['city_id'][0]));
 foreach($q_m->result_array() as $k=>$v){?>
   <a href="<?php echo JEWISH_URL;?>/classified/single_housing/<?php echo $this->allencode->encode($v['id']);?>">
   <li class="first">
   <?php
   $image=$this->postmod->get_single_post_image($v['id']);
    if(!empty($image)){?>
   <img src="<?php echo JEWISH_URL;?>/upload/<?php  echo $this->postmod->get_single_post_image($v['id'])?>" height="165" width="229"alt="">
   <?php }else{ ?>
   <img src="<?php echo JEWISH_URL;?>/images/not-available.png" height="165" width="229"alt="">
	   <?php } ?><h4><img src="<?php echo JEWISH_URL;?>/images/star1.png" alt=""><span class="g-text"><?php  $yrdata= strtotime($v['post_date']); echo date('jS F Y', $yrdata);?><strong><?php echo $v['post_title'];?></strong> 
-   ($<?php  echo $this->postmod->get_post_meta($v['id'],'ask')?>)-(<?php echo $this->postmod->get_post_meta($v['id'],'sqft')?>m<sup>2</sup>)
 Area -<?php  echo  $this->citymod->fetch_single_city($v['geo_area']);?></span></h4></li></a>
 <?php } 
} ?> 
   
</ul>
</div>
</div>
 <div class="clear"></div>
</section>
 </article>
</div>
<style>


#paging_container1{
	height: 320px;	
}

#paging_container2{
	height: 356px;	
}

#paging_container3{
	height: 190px;
}

#paging_container4{
	height: 307px;	
	overflow: hidden;
}
.less{
	display:none !important;
}
#paging_container8 .no_more{
    background-color: white;
    color: gray;
    cursor: default;
}

.ellipse{
	float: left;
}
.alt_page_navigation_gallery > .last{
	display:block !important;
}


.page_navigation , .alt_page_navigation{
	padding-bottom: 10px;
}
.page_navigation , .alt_page_navigation_gallery{
	padding-bottom: 10px;
}


.page_navigation a, .alt_page_navigation a{
	padding:3px 5px;
	margin:2px;
	color:white;
	text-decoration:none;
	float: left;
	font-family: Tahoma;
	font-size: 12px;
	background-color: white;
  color: #353f4d;
}
.page_navigation a, .alt_page_navigation_gallery a{
	padding:3px 5px;
	margin:2px;
	color:white;
	text-decoration:none;
	float: left;
	font-family: Tahoma;
	font-size: 12px;
	background-color: white;
  color: #353f4d;
}
.active_page{
	background-color:white !important;
	color:black !important;
}	

.content, .alt_content{
	color: black;
}
.page_link {
	display:block !important;
}
.content li, .alt_content li, .content > p{
	padding: 5px
}
</style>