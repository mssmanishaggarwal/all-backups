
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/addpost.css">
<script>console.log('view/housing/editpost.php')</script> 
<script src="<?php echo JEWISH_URL;?>/js/jquery.maskedinput.js" type="text/javascript"></script>
<?php //echo $this->uri->segment(3);?>
<div class="container"> 
<article class="page-content">
<ul class="page-nav">
    <li><a href="<?php echo JEWISH_URL;?>">Homepage</a></li>
    <li> > <a href="<?php echo JEWISH_URL;?>/post/post_edit/<?php echo $this->uri->segment(3)?>/<?php echo $this->uri->segment(4)?>">Edite Housing Post</a></li>
  </ul>
<?php //echo $email;
//echo $p_id;?>
<section class="body">
<?php $attributes = array('id' => 'addpost');
                   echo form_open_multipart('post/postupdate/', $attributes);
				   $this->db->select('*');
				   $this->db->where('id', $p_id );
				   $this->db->where('c_email', $email );
				   $query = $this->db->get('post');
				   $data = $query->result_array();
				 //  echo $this->db->last_query();
				   /*echo '<pre>';
				   print_r( $data);
				   echo '</pre>';*/
				   ?>
        <div class="posting fields">
             <div class="main-area">Contact Information</div>
                 <div class="top-area">  
                <label>
                <div class="label">Your Name</div>
                <input type="text" value="<?php echo $data[0]['contact_name']?>" name="contact_name" id="contact_name" size="16" maxlength="32" tabindex="1" required="required">
                </label>
                <label >
                <div class="label">Phone Number</div>
                <input type="tel" class="str" value="<?php echo $data[0]['contact_phone']?>" name="contact_phone" id="contact_phone" size="10" maxlength="16" tabindex="1" required="required" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}">
                </label>
                 </div>               

                 <div class="top-area">      
                <label > 
                <div class="label">Email</div>                  
                <input tabindex="1" type="text" class="req df dv" id="c_email" name="c_email" placeholder="Your email address" maxlength="60" autocapitalize="off"
                value="<?php echo $data[0]['c_email']?>" required="required">
                </label>
                <label>
                <div class="label">Confirm Email</div>
                <input tabindex="1" type="text" class="req df dv" id="cc_email" name="cc_email" placeholder="Type email address again" maxlength="60" autocapitalize="off" value="<?php echo $data[0]['c_email']?>" required="required">
                </label>
                </div>  
                     <div style="clear:both;"></div>
                    <input type="hidden" name="id" value="<?php echo $p_id;?>"  /> 
                    <input type="hidden" value="<?php ?>" name="user_id"  />  
                    <input type="hidden" value="<?php echo $data[0]['id']?>" name="post_id"  />         
                   <?php /*?> <input type="hidden" name="object_id" value="<?php echo $this->postmod->get_catid_by_postid($p_id);?>"  />
                    <input type="hidden" name="cat_id" value="<?php echo $this->postmod->get_catid_by_postid($p_id);?>"  /><?php */?>
                     <p>&nbsp;</p>
                    <p>&nbsp;</p>
             <span id="main-area">Housing Details</span>
          		<div class="main-area-three">           
                <label>
                    <div class="label">Posting Title</div>
                    <input tabindex="1" type="text" name="post_title" id="PostingTitle" maxlength="70" value="<?php echo $data[0]['post_title']?>" required="required">
                </label>
                </div>
             <div class="top-area"> 
                <label>
                <div class="label">City</div>
                      <select name="geo_area" class="city_selectr" required="required">
                      <option value="">Select City</option>
                      <?php $get_city=$this->citymod->fetch_city();
                      foreach($get_city as $v){?>
                      <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                      <?php }?>
                </select>
                </label>
              </div>
              <div class="top-area"> 
                <label>
                    <div class="label">Zip</div>
        <input type="text" id="postal_code" name="zipcode" size="6" maxlength="15" value="<?php echo $data[0]['zipcode']?>" required/>
                </label>
              </div>  
              <div class="main-area-three">
                       <label> <div class="label">State</div>
                        <input tabindex="1" type="text" name="state" id="PostingTitle" maxlength="70" value="<?php echo $data[0]['state']?>" required="required">
                        </label>
                </div>
 <div style="clear:both;"></div>  
 <div class="main-area-three">
          <label >
          <div class="label">Your Housing Description</div>
          <textarea  tabindex="1" rows="10" id="PostingBody" name="post_content" required="required"><?php echo $data[0]['post_content']?></textarea>
          </label>
 </div>
 <div style="clear:both;"></div> 
  
 <script>
 $(document).ready(function() {
    $(".city_selectr option[value='<?php echo $data[0]['geo_area']?>']").attr('selected','selected');
	$('.select-event').on('click',function(){
	$('.event_cat').slideToggle(500);
	$('.select-event').css({'border':'1px solid #bbb','color':''});
	});
  $("#contact_phone").mask("(999) 999-9999");
  $('#addpost').submit(function(kaushik){
	var fields=$('.event_cat').find('input[type="checkbox"]:checked');
   /* if (fields.length== 0) 
    { 
        $('.select-event').css({'border':'3px solid red','color':'red'});
		$('.select-event').html('Select at least one Housing Fature, Click Here');
       kaushik.preventDefault(); 
    } */

	});
		 $('Select option').each(function(){
      $(this).text($(this).text().charAt(0).toUpperCase() + $(this).text().slice(1));
    });
});
 </script>   
 <?php  
                   $this->db->select('*');
				   $this->db->where('post_id', $p_id );
				   $query = $this->db->get('housing_post_meta');
				   $data = $query->result_array();
				   //echo $this->db->last_query();
?>             
<script>
$(document).ready(function() { 
$( "#movein_month option[value='<?php echo $data[0]['movein_month']?>']" ).attr('selected','selected');
$( "#movein_day option[value='<?php echo $data[0]['movein_day']?>']" ).attr('selected','selected');
$( "#parking option[value='<?php echo $data[0]['parking']?>']" ).attr('selected','selected');
$( "#contact_ok option[value='<?php echo $data[0]['contact_ok']?>']" ).attr('selected','selected');
});

</script>            


  
<div class="top-area-house" style="margin-top: 1px;">       
    <label><div class="label">Rent / Listing Price $</div>
        <input type="text" tabindex="1" size="4" maxlength="11" name="ask" value="<?php echo $data[0]['ask']?>">
    </label>
    <label>
  <div class="label">Avaiable Day</div>

    <select name="movein_day" id="movein_day" >
  <option value="">Select Day</option>
  <?php for($i=1;$i<=31;$i++){?>
  <option value="<?php echo $i;?>"><?php echo $i;?></option>
  <?php } ?>
  </select>
</label>
<label><div class="label">Parking</div><select tabindex="1" name="parking" id="parking">
<option value="" selected="selected">--</option>
<option value="carport">carport</option>
<option value="attached garage">attached garage</option>
<option value="detached garage">detached garage</option>
<option value="off-street parking">off-street parking</option>
<option value="street parking">street parking</option>
<option value="valet parking">valet parking</option>
</select></label>
</div>
<div class="top-area-house" style="  margin-top: 1px;"> 
<label><div class="label" >Square Footage</div>
    <input type="text" tabindex="1" size="4" maxlength="6" name="sqft" id="Sqft" value="<?php echo $data[0]['sqft']?>">
    </label>

<label>
  <div class="label">Available month</div>

  <select style="margin-right:0px;width: 138px;" name="movein_month" id="movein_month">
 
  <option value="1" >jan</option>
  <option value="2">feb</option>
  <option value="3">mar</option>
  <option value="4">apr</option>
  <option value="5">may</option>
  <option value="6">jun</option>
  <option value="7">jul</option>
  <option value="8">aug</option>
  <option value="9">sep</option>
  <option value="10">oct</option>
  <option value="11">nov</option>
  <option value="12">dec</option>
  </select>
</label>
<label >
  <div class="label">Year</div>
  <select name="contact_ok" style="margin-right:0px;width: 138px;" id="contact_ok">
  <?php for($i=2015;$i<=2025;$i++):?>
  <option value="<?php echo $i;?>"><?php echo $i;?></option>
  <?php endfor; ?>
  </select>
  </label>
 <label><div class="label">Laundry</div>
 <select tabindex="1" name="laundry" id="laundry">
<option value="<?php echo $data[0]['laundry']?>" selected="selected"><?php echo $data[0]['laundry']?></option>
<option value="w/d in unit">w/d in unit</option>
<option value="laundry in bldg">laundry in bldg</option>
<option value="laundry on site">laundry on site</option>
<option value="w/d hookups">w/d hookups</option>
</select></label>
</div>
<div class="top-area-house" style="  margin-top: 1px;"> 
<label>
<div class="label">Open House Date (1)</div>
<input type="date" name="sale_date_1" value="<?php echo $data[0]['sale_date_1']?>"/>
</label>
<label>
<div class="label">Open House Date (2)</div>
<input type="date" name="sale_date_2" value="<?php echo $data[0]['sale_date_2']?>"/>
</label>
<label>
<div class="label">Open House Date (3)</div>
 <input type="date" name="sale_date_3" value="<?php echo $data[0]['sale_date_3']?>"/>
 </label>
</div>
<div style="clear:both;"></div>

 <div class="main-area-three">
  <label>
          <span class="label">Housing Feature</span>
     <div class="select-event">Click here to select</div>
  </label>
  <div class="event_cat" style="display:block;">   

<label class=" ">
  <label>
   <input type="hidden" name="housing_wanted" value="" />
  <input tabindex="1" type="checkbox" value="yes" name="housing_wanted" <?php if($data[0]['housing_wanted']=='yes'){
	echo 'checked';
}?>>housing wanted</label>
  <label>
  <input type="hidden" name="housing_offered" value="" />
  <input tabindex="1" type="checkbox" value="yes" name="housing_offered" <?php if($data[0]['housing_offered']=='yes'){
	echo 'checked';
}?>>housing offered</label> 
<label>
<input type="hidden" name="wheelchaccess" value="" />
<input tabindex="1" type="checkbox" value="yes" name="wheelchaccess" <?php if($data[0]['wheelchaccess']=='yes'){
	echo 'checked';
}?>>wheelchair accessible</label> 
<label>
<input type="hidden" name="no_smoking" value="" />
<input tabindex="1" type="checkbox" value="yes" name="no_smoking" <?php if($data[0]['no_smoking']=='yes'){
	echo 'checked';
}?>>no smoking</label></br>
<label>
<input type="hidden" name="private_bath" value="" />
<input tabindex="1" type="checkbox" value="yes" name="private_bath" <?php if($data[0]['private_bath']=='yes'){
	echo 'checked';
}?>>private bath</label>
<label>
<input type="hidden" name="private_room" value="" />
<input tabindex="1" type="checkbox" value="yes" name="private_room" <?php if($data[0]['private_room']=='yes'){
	echo 'checked';
}?>>private room</label>
        </br>
    <label>
    <input type="hidden" name="pets_cat" value="" />
    <input tabindex="1" type="checkbox" name="pets_cat" value="cats accepted" <?php if($data[0]['pets_cat']=='cats accepted'){
	echo 'checked';
}?>>cats accepted</label>
<label>
<input type="hidden" name="pets_dog" value="" />
<input tabindex="1" type="checkbox" name="pets_dog" value="dogs accepted" <?php if($data[0]['pets_dog']=='dogs accepted'){
	echo 'checked';
}?>>dogs accepted</label>
           

            
               <?php /*?> <label for="oc">
    <input tabindex="1" type="checkbox" id="oc" name="contact_ok" value="ok" <?php if($data[0]['contact_ok']=='ok'){
	echo 'checked';
}?>>
    ok for others to contact you about other services, products or commercial interests
</label><?php */?>
</div>
            </div>

       
            
            <div id="uploader">
            <h5 class="upl">Upload House Images</h5><br />
<input name="post_images[]" type="file" id="uploader" multiple="multiple">
<em> you can select multiple image by pressing Ctrl</em>
</div>
<script>
$(document).ready(function() {
		$(".uploaded >a").on('click',function(e){
			e.preventDefault();
			var getval=$(this).attr('name');
			var imgname=$(this).attr('data');
			//alert(imgname);
				$.ajax({
                      url: '<?php echo JEWISH_URL;?>'+'/post/delete_image_bd/?ded='+getval+'&imgurl='+imgname,
                      type: 'POST',
                      success: function(data){
						  			
									alert('Image Deleted');
									location.reload();
		                    				// $(".list-v").html(data)
									
                             }
                  });

			});
		
	});
</script>
<div class="uploaded">
<h1>Uploaded Image <em>(x) to Delete image</em></h1>

<?php
 
                   $this->db->select('*');
				   $this->db->where('post_id', $p_id );
				   $query = $this->db->get('images');
				   $data2 = $query->result_array();
				   //echo $this->db->last_query();
					foreach( $data2 as $l ){
?>
<img src="<?php echo JEWISH_URL;?>/upload/<?php echo $l['img']?>" height="200" width="200" /><a href="#" data="<?php echo $l['img']?>" name="<?php echo $l['id'];?>"><span class="del">X</span>
</a><?php } ?>
</div>
        </div>
    <p>&nbsp;</p>      
       <input type="submit" value="Update this post" name="submtadd"/>
        
<?php echo form_close(); ?>

</section>
</article>
</div>