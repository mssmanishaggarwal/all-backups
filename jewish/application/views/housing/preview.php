<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/addpost.css"> 
<script>console.log('view/housing/preview.php')</script> 
<script>
        history.forward();
		$(document).ready(function($) {
            $(".thumb > img").mouseenter(function(){
				var img_url=$(this).attr('src');
				$(".big_image > img").attr('src', img_url);
				})
        });
    </script>
    
 <div class="container">
 <article class="page-content">     
 <section class="body" >
 <div class="posting">
  <?php //echo $id;?>  
    
<?php $attributes = array('id' => 'addpost');
                   echo form_open_multipart('post/publish/', $attributes);
				   ?>
  <?php 
  
$query = $this->db->query("SELECT * FROM post WHERE id='".$id."'");
foreach ($query->result_array() as $row){
	?>
    
    <div class="parent">
    <span class="big"> <?php 
	/*echo '$-'.$this->postmod->get_post_meta($id,'ask').'  /  '; echo $this->postmod->get_post_meta($id,'sqft').'Square Footage  ';*/
	 ?><?php  echo $row['post_title']?></span><span class="small"><?php echo $this->citymod->fetch_single_city($row['geo_area']).',   ';?>
	 <?php echo ''.$row['state'].', '?><?php echo ''.$row['zipcode']?></span>
     </div>
   
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



    </div>
    <div style="clear:both;"></div>
    <div class="thumb">
<?php $q= $this->db->query("SELECT * FROM images WHERE post_id='".$id."'");  
foreach ($q->result_array() as $img){ ?>
     <img src="<?php echo JEWISH_URL;?>/upload/<?php echo $img['img'];?>" height="50" width="50" class="images"/>
 <?php } ?>  
 	</div>  
     <div style="clear:both;"></div>
     <div class="post_content"><h2>Property Details</h2><hr><?php echo $row['post_content']?></div>
     
     <div class="post_content"><h2>General information</h2><hr>
     <div class="post-left">
     <table width="100%" border="0" cellspacing="0" ><!--class="gradienttable"-->
   <tr>
    <td>Housing Wanted</td>
    <td><?php echo $this->postmod->get_post_meta($id,'housing_wanted')?></td>
  </tr>
   <tr>
    <td>Housing Offered</td>
    <td><?php echo $this->postmod->get_post_meta($id,'housing_offered')?></td>
  </tr>
  <tr>
  <td colspan="2"><div align="center"><strong>AVAILABLE FROM</strong></div></td>
  </tr>
  <tr>
    <td>Date</td>
    <td><?php switch($this->postmod->get_post_meta($id,'movein_month')){
						case 1:
						echo 'Jan';
						break;	
						case 2:
						echo 'Feb';
						break;	
						case 3:
						echo 'Mar';
						break;
						case 4:
						echo 'Apr';
						break;
						case 5:
						echo 'May';
						break;
						case 6:
						echo 'June';
						break;
						case 7:
						echo 'July';
						break;
						case 8:
						echo 'Aug';
						break;
						case 9:
						echo 'Sept';
						break;
						case 10:
						echo 'Oct';
						break;
						case 11:
						echo 'Nov';
						break;
						case 12:
						echo 'Dec';
						break;
	}?>  <?php echo $this->postmod->get_post_meta($id,'movein_day')?>, <?php echo $this->postmod->get_post_meta($id,'contact_ok')?></td>
  </tr>

  <tr>
  <td colspan="2"><div align="center"><strong>OPEN HOUSE DATES</strong></div></td>
  </tr>
<tr>
    <td>Date One</td>
    <td><?php echo $this->postmod->get_post_meta($id,'sale_date_1')?></td>
  </tr>
  
  <tr>
    <td>Date Two</td>
    <td><?php echo $this->postmod->get_post_meta($id,'sale_date_2')?></td>
  </tr>
<tr>
    <td>Date Three</td>
    <td><?php echo $this->postmod->get_post_meta($id,'sale_date_3')?></td>
  </tr>
  
  </table>
   </div> 
  <div class="post-left right">
  <table width="100%" border="0" cellspacing="0" >
  
    <tr>
    <td>Square Footage</td>
    <td><?php echo $this->postmod->get_post_meta($id,'sqft')?></td>
  </tr>
  
  <tr>
    <td>Rent / Listing Price </td>
    <td>$&nbsp;<?php echo $this->postmod->get_post_meta($id,'ask')?></td>
  </tr>
  
  <tr>
    <td>Parking</td>
    <td><?php echo ucwords($this->postmod->get_post_meta($id,'parking'))?></td>
  </tr>
 <tr>
    <td>Laundry</td>
    <td><?php echo ucwords($this->postmod->get_post_meta($id,'laundry'))?></td>
  </tr>
  <tr>
    <td>Wheelchair access</td>
    <td ><?php echo ucwords($this->postmod->get_post_meta($id,'wheelchaccess'))?></td>
  </tr>
  <tr>
    <td>Smoking</td>
    <td><?php echo ucwords($this->postmod->get_post_meta($id,'no_smoking'))?></td>
  </tr>
<tr>
    <td>Private  Bath</td>
    <td><?php echo ucwords($this->postmod->get_post_meta($id,'private_bath'))?></td>
  </tr>
  <tr>
    <td>Private Room</td>
    <td><?php echo ucwords($this->postmod->get_post_meta($id,'private_room'))?></td>
  </tr>
  <tr>
    <td>Pets</td>
    <td><?php echo ucwords($this->postmod->get_post_meta($id,'pets_cat'))?><?php echo ucwords($this->postmod->get_post_meta($id,'pets_dog'))?></td>
  </tr>
<?php /*?>  <tr>
    <td>Pets Dog</td>
    <td><?php echo ucwords($this->postmod->get_post_meta($id,'pets_dog'))?></td>
  </tr><?php */?>
    
    </table></div>
    </div>
 <?php } ?> 
 <div class="post-btn">
 <span class="prev-button">
 <input type="hidden" name="post_id" value="<?php echo $id;?>"/>
 <input type="hidden" name="client_mail" value="<?php echo $post_mail;?>"/>
  <input type="hidden" name="type" value="housing"/>
 </span>
 <?php $qm= $this->db->query("SELECT `status` FROM post WHERE id='".$id."'"); 
 foreach ($qm->result_array() as $status){ 
if($status['status']!=1){ ?>
 <span class="next-button">
 <input type="submit" value="Publish" class="publish"/> 
 </span>  
<?php 
}
} ?>

<a href="<?php echo JEWISH_URL;?>/post/post_edit/<?php echo  $this->allencode->encode($id);?>/
<?php echo  $this->allencode->encode($post_mail);?>/housing/" ><input type="button" value="Edit This Post" class="edit_post_btn" /></a>
<a href="<?php echo JEWISH_URL;?>/post/delete/<?php echo $this->allencode->encode($id);?>/<?php echo $this->allencode->encode($post_mail);?>"><input type="button" value="Delete This Post" class="delete_post_btn" /></a>
</div>
<?php echo form_close(); ?>   
</div>
</section>
</article>
</div>
<style>
strong{
	font-weight:bold;
	text-decoration:underline;
	text-transform:capitalize;
}
</style>
<script>
$(document).each(function(santana) {
    $( "td:empty" ).parent().css('opacity','0.3');
/*  .text( "Was empty!" )*/
});
</script>