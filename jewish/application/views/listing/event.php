<script>console.log('view/listing/event.php')</script>

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

	   window.location.href ="<?php echo JEWISH_URL;?>/classified/search/event/";

	   });

 });

	/* $(document).ready(function() {

		$("#house_srch").submit(function(e){

			var other_data = $('#house_srch').serialize(); 

			e.preventDefault();

				$.ajax({

                      url: '<?php //echo JEWISH_URL;?>'+'/classified/houseajax/?'+other_data,

                      type: 'POST',

                      success: function(data){

									

		                    				 $(".list-v").html(data)

									

                             }

                  });



			})

	});*/

 



</script>

<script type="text/javascript" src="<?php echo JEWISH_URL;?>/js/jquery.pajinate.js"></script>
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
<div class="container">

 <article class="page-content">

  <ul class="page-nav" id="vot">

    <li><a href="<?php echo JEWISH_URL;?>">Homepage></a></li>

     <li><a href="<?php echo JEWISH_URL;?>/classified/search/<?php echo $type?>/"><?php echo ucfirst($type)?></a></li>

    <?php /*?><li>><a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>"><?php //echo $this->postmod->get_single_catname($_GET['cat_id']);?></a></li><?php */?>

  </ul><div class="create_post"><a class="event-heading" href="<?php echo JEWISH_URL;?>/post/addeventpost/<?php //echo $this->uri->segment(3)?>">create post</a></div>

    <?php /*if(isset($_GET['cat_id']))

	{ 

	unset($cat_id);

	$cat_id=$_GET['cat_id'];}*/

	

	//echo $cat_id;?>

    <?php 

	$this->db->select('post_id');

			 if(isset($_GET['event_advertisement'])){

				$this->db->where('event_advertisement', $this->input->get("event_advertisement") );

				}

			if(isset($_GET['event_art'])){

				$this->db->where('event_art', $this->input->get("event_art") );

				}	

			 if(isset($_GET['event_career'])){

				$this->db->where('event_career', $this->input->get("event_career") );

				 }

			if(isset($_GET['event_charitable'])){

					$this->db->where('event_charitable', $this->input->get("event_charitable") );

				}

			 if(isset($_GET['event_competition'])){

				 $this->db->where('event_competition', $this->input->get("event_competition") );

			 }

			 if(isset($_GET['event_dance'])){

				   $this->db->where('event_dance', $this->input->get("event_dance") );

			   }

			 if(isset($_GET['event_festival'])){

					$this->db->where('event_festival', $this->input->get("event_festival") );

				}

			 if(isset($_GET['event_fitness_wellness'])){

					$this->db->where('event_fitness_wellness', $this->input->get("event_fitness_wellness") );

				}	

			 if(isset($_GET['event_food'])){

					$this->db->where('event_food', $this->input->get("event_food") );

				}

			 if(isset($_GET['event_free'])){

					$this->db->where('event_free', $this->input->get("event_free") );

				}

			 if(isset($_GET['event_kidfriendly'])){

					$this->db->where('event_kidfriendly', $this->input->get("event_kidfriendly") );

				}

			 if(isset($_GET['event_literary'])){

					$this->db->where('event_literary', $this->input->get("event_literary") );

				}

			 if(isset($_GET['event_music'])){

					$this->db->where('event_music', $this->input->get("event_music") );

				}

			 if(isset($_GET['event_outdoor'])){

					$this->db->where('event_outdoor', $this->input->get("event_outdoor") );

				}

			 if(isset($_GET['event_sale'])){

					$this->db->where('event_sale', $this->input->get("event_sale") );

				}

			if(isset($_GET['event_singles'])){

					$this->db->where('event_singles', $this->input->get("event_singles") );

				}	

			if(isset($_GET['event_geek'])){

					$this->db->where('event_geek', $this->input->get("event_geek") );

				}	

			if(isset($_GET['start_month']) && $_GET['start_month']!=''){

					$this->db->where('start_month', $this->input->get("start_month") );

				}

			if(isset($_GET['start_date']) && $_GET['start_date']!=''){

					$this->db->where('start_date', $this->input->get("start_date") );

				}

			if(isset($_GET['event_duration']) && $_GET['event_duration']!=''){

					$this->db->where('event_duration', $this->input->get("event_duration") );

				}													
		$query=$this->db->order_by('id', 'DESC');	
		$query = $this->db->get('event_post_meta');
		$data = $query->result_array();
		$art=array();
		foreach( $data as $k=>$v){
			array_push($art,$v['post_id']);
		}
		?>

<script>

$(document).ready(function(){

				$('#paging_container3').pajinate({

					items_per_page : 5,

					item_container_id : '.alt_content',

					nav_panel_id : '.alt_page_navigation'

					

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

    		<h2>Event Category</h2>

            <ul>

             <li><a href="<?php echo JEWISH_URL;?>/classified/search/event/">Event Advertisement</a></li>

            </ul>

    </article><?php */?>

 <script>

$(document).ready(function() {

	 $( "#start_month option[value='<?php echo $_GET['start_month'] ?>']" ).attr('selected','selected');

	/* $( "#event_duration option[value='<?php //echo $_GET['event_duration'] ?>']" ).attr('selected','selected');*/

	 $( "#start_date option[value='<?php echo $_GET['start_date'] ?>']" ).attr('selected','selected');

	 });

</script>  

 <?php $attributes = array('id' => 'house_srch','method' => 'get');

            echo form_open_multipart('classified/search/event/?', $attributes);

				   ?>

 <article class="check-area">

 <label><input type="checkbox" name="event_advertisement" value="yes" <?php if(isset($_GET['event_advertisement'])){ echo 'checked';}?> onclick="this.form.submit();">

 Event Advertisement</label>

 <?php /*?><input type="hidden" name="cat_id" value="<?php echo $cat_id;?>" /><?php */?>

 <label><input type="checkbox" name="event_art" value="yes" <?php if(isset($_GET['event_art'])){ echo 'checked';}?> onclick="this.form.submit();">

 Art/Film</label>

 <label><input type="checkbox" name="event_career" value="yes" <?php if(isset($_GET['event_career'])){ echo 'checked';}?> onclick="this.form.submit();">Career</label>

 <label><input type="checkbox" name="event_charitable" value="yes" <?php if(isset($_GET['event_charitable'])){ echo 'checked';}?> onclick="this.form.submit();">

 Charity</label> 

 <label><input type="checkbox" name="event_competition" value="yes" <?php if(isset($_GET['event_competition'])){ echo 'checked';}?> onclick="this.form.submit();">Competition</label>

  <label><input type="checkbox" name="event_dance" value="yes" <?php if(isset($_GET['event_dance'])){ echo 'checked';}?> onclick="this.form.submit();">

Dance</label> 

  <label><input type="checkbox" name="event_festival" value="yes" <?php if(isset($_GET['event_festival'])){ echo 'checked';}?> onclick="this.form.submit();">Festival/Fair</label>

<label><input type="checkbox" name="event_fitness_wellness" value="yes" <?php if(isset($_GET['event_fitness_wellness'])){ echo 'checked';}?> onclick="this.form.submit();">

Fitness/Health</label>  

<label><input type="checkbox" name="event_food" value="yes" <?php if(isset($_GET['event_food'])){ echo 'checked';}?> onclick="this.form.submit();">

Food/Drink</label>

<?php /*?><label><input type="checkbox" name="event_free" value="yes" <?php if(isset($_GET['event_free'])){ echo 'checked';}?> onclick="this.form.submit();">

free</label>  <?php */?>

<label><input type="checkbox" name="event_kidfriendly" value="yes" <?php if(isset($_GET['event_kidfriendly'])){ echo 'checked';}?> onclick="this.form.submit();">

Kid Friendly</label>  

<label><input type="checkbox" name="event_literary" value="yes" <?php if(isset($_GET['event_literary'])){ echo 'checked';}?> onclick="this.form.submit();">

Literary</label>  

<label><input type="checkbox" name="event_music" value="yes" <?php if(isset($_GET['event_music'])){ echo 'checked';}?> onclick="this.form.submit();">

Music</label>  

<label><input type="checkbox" name="event_outdoor" value="yes" <?php if(isset($_GET['event_outdoor'])){ echo 'checked';}?> onclick="this.form.submit();">

Outdoor</label>

<?php /*?><label><input type="checkbox" name="event_sale" value="yes" <?php if(isset($_GET['event_sale'])){ echo 'checked';}?> onclick="this.form.submit();">

sale</label><?php */?>

<label><input type="checkbox" name="event_singles" value="yes" <?php if(isset($_GET['event_singles'])){ echo 'checked';}?> onclick="this.form.submit();">

Singles</label>

<label><input type="checkbox" name="event_geek" value="yes" <?php if(isset($_GET['event_geek'])){ echo 'checked';}?> onclick="this.form.submit();">

Technology</label>



              

 </article>

<!-- <article class="check-area last" style="border:none;">

<input type="reset" value="reset" id="rst">

<input type="submit" value="search">



</article>-->

<?php echo form_close(); ?>

<?php $attributes = array('id' => 'house_srch','method' => 'get');

            echo form_open_multipart('classified/search/event/?', $attributes);

				   ?>

                   <?php /*?> <input type="hidden" name="cat_id" value="<?php echo $cat_id;?>" /><?php */?>

<article class="check-area">                   

<p>Select Month</p>

                    <select class="select1" name="start_month"  id="start_month" >

                    	<option></option>

                        <option value="1">Jan</option>

                        <option value="2">Feb</option>

                        <option value="3">Mar</option>

                        <option value="4">Apr</option>

                        <option value="5">May</option>

                        <option value="6">Jun</option>

                        <option value="7">Jul</option>

                        <option value="8">Aug</option>

                        <option value="9">Sep</option>

                        <option value="10">Oct</option>

                        <option value="11">Nov</option>

                        <option value="12">Dec</option>

                    </select>

              <p>Start Date</p>

            <select class="select1" name="start_date"  id="start_date" >

            <option ></option>

            <?php for($i=1;$i<32;$i++){?>

                    <option value="<?php echo $i;?>"><?php echo $i;?></option>

            <?php } ?>

            </select>

            <?php /*?><p>Event Duration</p>

            <select class="select1" name="event_duration"  id="event_duration" >

            <option ></option>

            <?php for($i=1;$i<15;$i++){?>

                    <option value="<?php echo $i;?>"><?php echo $i;?></option>

            <?php } ?>

                </select> day(s)<?php */?>

 

   <article class="check-area last" style="border:none;">

<input type="reset" value="reset" id="rst">

<input type="submit" value="search">

</article>

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