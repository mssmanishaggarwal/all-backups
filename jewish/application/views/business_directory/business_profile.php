<script>console.log('view/business_directory/business_profile.php');</script>
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/business.css">
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/addpost.css">
<div class="container">
 <article class="page-content">
  <ul class="page-nav">
    <li><a href="<?php echo JEWISH_URL;?>">homepage></a></li>
    <li><a href="<?php echo JEWISH_URL;?>/business_directory/business_profile/<?php echo $this->uri->segment(3)?>">Edit Your Business</a></li>
  </ul>

<?php 
$bd_post=$this->businessmod->fetch_bdpost_id($bd_id);
/*echo '<pre>';
print_r($bd_post);
echo '</pre>';*/
?>
<script>
$(document).ready(function() {
    $(".um_im").on('click',function(){
		$(".chn_img").trigger('click');
		var id=$(this).attr('pid');
	});
	$('.chn_img').change(function(){
		$(".sbmt").trigger('click');
    });
	$("#im_form").submit(function(e){
			var id=$(".um_im").attr('pid');
			e.preventDefault();
			$.ajax({
                         url: "<?php echo site_url('business_directory/business_image'); ?>/"+id,
                         type: "POST",
                         data:  new FormData(this),
                         contentType: false,
                         cache: false,
                         processData:false,
                         success: function(data){
						var img_url="<?php echo site_url('upload/'); ?>/"+data;	 
						$(".profimage").attr('src',img_url);
						},
                        error: function(){} 	        
                      });
		});
  });

</script>
<style>
.page-event h1 {
	border-top:none;
}
</style>
<div style="clear:both;"></div>
<section class="page-event">
<h1 class="add_heading">Edit your Business profile</h1>
<section class="single-description-block clearfix">
        <section class="single-description-block-top clearfix">
          <div class="single-block-top-imager">
          <?php $img=$this->businessmod->get_bd_image($bd_post[0]['id'])?>
          <?php if(empty($img[0]['img'])){?>
          <img src="<?php echo JEWISH_URL;?>/images/not-available.png" height="150" width="200" class="profimage"/>
          <?php /*?><div class="imageup"><a  pid="<?php echo $this->uri->segment(3);?>" class="um_im">Click here to Add Profile Image</a></div><?php */?>
          <form id="im_form" style="display:none;" enctype="multipart/form-data">
          <input type="file" name="post_images" value="Change Image"  class="chn_img" >
          <input type="submit" value="submit" class="sbmt"/>
          </form>
          <?php }else { ?>
          <div class="imageup"><img src="<?php echo JEWISH_URL;?>/upload/<?php echo $img[0]['img']?>" height="150" width="200" class="profimage" ></div>
          <?php /*?><div class="imageup"><a  pid="<?php echo $this->uri->segment(3);?>" class="um_im">Click here to Change Profile Image</a></div><?php */?>
          <form id="im_form" style="display:none;"  enctype="multipart/form-data">
          <input type="file" name="post_images" value="Change Image"  class="chn_img" >
          <input type="submit" value="submit" class="sbmt"/>
          </form>
          <?php } ?>
          </div>
          <div class="single-block-top-middle">
            <div class="single-block-top-middle-name"><?php echo $bd_post[0]['b_name']?></div>
            <div class="single-block-top-middle-star">
              <?php /*?><span><img src="<?php echo JEWISH_URL;?>/images/star.jpg" alt="" title=""></span>
              <span><img src="<?php echo JEWISH_URL;?>/images/star.jpg" alt="" title=""></span>
              <span><img src="<?php echo JEWISH_URL;?>/images/star.jpg" alt="" title=""></span>
              <span><img src="<?php echo JEWISH_URL;?>/images/star.jpg" alt="" title=""></span>
              <span><img src="<?php echo JEWISH_URL;?>/images/star-active.jpg" alt="" title=""></span>
              234 Reviews<?php */?>
            </div>
            <div class="single-block-top-middle-desig">Category : <?php $this->businessmod->get_bd_catby_id($bd_post[0]['b_cat_id']);?></div>
          <div class="deso"><?php echo $bd_post[0]['b_des'];?></div>
          </div>
          <div class="single-block-top-right">
          <h2 class="addr">Address</h2>
            <p><?php echo $bd_post[0]['b_address1'];?></p>
            <p><?php echo $bd_post[0]['b_address2'];?></p>
            <p><?php echo $this->citymod->fetch_single_city($bd_post[0]['b_city']);?></p>
            <p><?php echo $bd_post[0]['b_state'];?></p>
            <p><?php echo $bd_post[0]['b_zipcode'];?></p>
            <p><?php echo $bd_post[0]['b_url'];?></p>
            <span><?php echo $bd_post[0]['b_phone'];?></span>
<span><a href="<?php echo JEWISH_URL;?>/business_directory/business_edit/<?php echo $this->uri->segment(3);?>"><input type="button" name="b_submit" value="Edit Profile" id="b_submit"/></a></span>
          </div>
          
        </section>
        <section class="single-description-block-bottom clearfix">
 <div class="uploaded">
<h1>Uploaded Image <em>(x) to Delete image</em></h1>

<?php
 
                   $this->db->select('*');
				   $this->db->where('bd_id', $bd_post[0]['id'] );
				   $query = $this->db->get('images');
				   $data2 = $query->result_array();
				   //echo $this->db->last_query();
					foreach( $data2 as $l ){
?>
<img src="<?php echo JEWISH_URL;?>/upload/<?php echo $l['img']?>" height="200" width="200" /><a href="#" data="<?php echo $l['img']?>" name="<?php echo $l['id'];?>"><span class="del">X</span>
</a><?php } ?>
</div>
          
        </section>
      </section>  
</section>
 <div class="clear"></div>
 </article>
</div>
<script>
$(document).ready(function() {
      		$(".uploaded >a").on('click',function(e){
			e.preventDefault();
			var getval=$(this).attr('name');
			var imgname=$(this).attr('data');
			var gt=confirm('Do you want to delete this image?');
			if(gt==true){
				$.ajax({
                      url: '<?php echo JEWISH_URL;?>'+'/post/delete_image/?ded='+getval+'&imgurl='+imgname,
                      type: 'POST',
                      success: function(data){
						  			
									//alert('Image Deleted');
									location.reload();
		                    				// $(".list-v").html(data)
									
                             }
                  });
			}
			});
});
</script>