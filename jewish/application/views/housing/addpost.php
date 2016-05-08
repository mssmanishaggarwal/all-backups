<script>console.log('view/housing/addpost.php')</script>
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/addpost.css">
<script src="<?php echo JEWISH_URL;?>/js/jquery.maskedinput.js" type="text/javascript"></script>
<div class="container"> 
<article class="page-content">
<ul class="page-nav">
    <li><a href="<?php echo JEWISH_URL;?>">Homepage</a></li>
    <li> > <a href="<?php echo JEWISH_URL;?>/classified/search/housing/">Housing</a></li>
    <li> > <a href="<?php echo JEWISH_URL;?>/post/addhousingpost/">Add Post</a></li>
  </ul>
<?php //echo $parent_id.'---'.$child_id;?> 
<?php  $now = new \DateTime('now');$year=$now->format('Y');
															$day=$now->format('j');
                                                           $month=str_replace('0','',$now->format('m'));
														?>
<script>
$(document).ready(function() {
   
	$('.select-event').on('click',function(){
	$('.event_cat').slideToggle(500);
	$('.select-event').css({'border':'1px solid #bbb','color':''});
	});
  
  $('#addpost').submit(function(kaushik){
	var fields=$('.event_cat').find('input[type="checkbox"]:checked');
  /*  if (fields.length== 0) 
    { 
        $('.select-event').css({'border':'3px solid red','color':'red'});
		$('.select-event').html('Select at least one Housing Fature, Click Here');
       kaushik.preventDefault(); 
    } */


	});
	
	$("#contact_phone").mask("(999) 999-9999");
	
	 $('Select option').each(function(){
      $(this).text($(this).text().charAt(0).toUpperCase() + $(this).text().slice(1));
    });

	
	
		$( "#contact_ok option[value='<?php echo $year;?>']" ).attr('selected','selected');
	$( "#movein_month option[value='<?php  echo $month;?>']" ).attr('selected','selected');
	$( "#movein_day option[value='<?php  echo $day;?>']" ).attr('selected','selected');
	
});

	
</script> 
<section class="body">
<?php $attributes = array('id' => 'addpost');
                   echo form_open_multipart('post/otr/', $attributes);
				   ?>
        <div class="posting fields">
            <div class="main-area">Contact Information</div>
                    <div class="top-area">
                             <label >
                            <div class="label">Your Name</div>
                            <input type="text" value="" name="contact_name" id="contact_name" size="16" maxlength="32" tabindex="1" required="required">
                        </label>          
                             <label >
                            <div class="label">Phone</div> 
                            <input type="tel" class="std" value="" name="contact_phone" id="contact_phone" size="10" maxlength="16" placeholder="(555) 555-1212" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}" required="required">
                        </label>   
                    </div>
                    <div class="top-area right">            
                    <label >   
                     <div class="label">Email</div>                    
                    <input tabindex="1" type="text" class="req df dv" id="c_email" name="c_email" placeholder="Your email address" maxlength="60" autocapitalize="off" required="required">
                     </label>
                     <label >   
                     <div class="label">Confirm Email</div>    
                    <input tabindex="1" type="text" class="req df dv" id="cc_email" name="cc_email" placeholder="Type email address again" maxlength="60" autocapitalize="off" required="required">
                     </label>
                     </div>	
                     <div style="clear:both;"></div>
        <input type="hidden" value="<?php ?>" name="user_id"  />  
    <?php /*?><input type="hidden" value="<?php echo $child_id;?>" name="object_id"  /> <?php */?> 
                    
<p>&nbsp;</p>
<p>&nbsp;</p>
             <span id="main-area">Housing Details</span>
          		<div class="main-area-three">
                       <label> <div class="label">Posting Title</div>
                        <input tabindex="1" type="text" name="post_title" id="PostingTitle" maxlength="70" value="" required="required">
                        </label>
                </div>
                 <div class="top-area"> 
                     <label ><div class="label">City</div>
                      <select name="geo_area" class="city_select">
                      <option value="">Select City</option>
                      <?php $get_city=$this->citymod->fetch_city();
                      foreach($get_city as $v){?>
                      <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                      <?php }?>
                </select>
                </label>
                </div>
                <div class="top-area right">
                     <label><div class="label">Zip</div>
                    <input  id="postal_code" name="zipcode" size="6" maxlength="15" type="text" required="required">
                </label>
                </div>
                <div class="main-area-three">
                       <label> <div class="label">State</div>
                        <input tabindex="1" type="text" name="state" id="PostingTitle" maxlength="70" value="" required="required">
                        </label>
                </div>
                <div style="clear:both;"></div>
                <div class="main-area-three">
                <label>
                        <span class="label">Your Housing Description</span>
                    <textarea class="req" tabindex="1" rows="10" id="PostingBody" name="post_content" required="required"></textarea>
                </label>
            
				</div>

         
<div class="top-area-five">
 <label ><div class="label">Rent / Listing Price $</div>
       <input type="text" tabindex="1" size="4" maxlength="11" name="ask" value="" placeholder="Rent or Listing Price">
    </label>
           <label>
  <div class="label">Available Day</div>
  <select name="movein_day" id="movein_day">
  <?php for($i=1;$i<=31;$i++){?>
  <option value="<?php echo $i;?>"><?php echo $i;?></option>
  <?php } ?>
  </select>
</label> 
    <label>
<div class="label">Parking</div>
<select tabindex="1" name="parking" id="parking">
<option value="" selected="selected">-</option>
<option value="carport">carport</option>
<option value="attached garage">attached garage</option>
<option value="detached garage">detached garage</option>
<option value="off-street parking">off-street parking</option>
<option value="street parking">street parking</option>
<option value="valet parking">valet parking</option>
</select>
</label>
</div>

<div class="top-area-five"> 

<label ><div class="label">Square Footage</div>
        <input type="text" tabindex="1" size="4" maxlength="6" name="sqft" id="Sqft" >
    </label>
<label >
  <div class="label">Available Month</div>
  <select style="margin-right:0px;width: 138px;" name="movein_month" id="movein_month">
  <option value="1">jan</option>
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
  
 <label>
 <div class="label">Laundry</div>
 <select tabindex="1" name="laundry" id="laundry">
<option value="" selected="selected">-</option>
<option value="w/d in unit">w/d in unit</option>
<option value="laundry in bldg">laundry in bldg</option>
<option value="laundry on site">laundry on site</option>
<option value="w/d hookups">w/d hookups</option>
</select></label>

</div>
<div class="top-area-five"> 
<label>
<div class="label">Open house date (1)</div>
 
<input type="date" name="sale_date_1" />
</label>

<label>
<div class="label">Open house date (2)</div>
<input type="date" name="sale_date_2"/>

</label>
<label>
<div class="label">Open house date (3)</div>

 <input type="date" name="sale_date_3" />
</label>
</div>

<div style="clear:both;"></div>


   

<!--============================-->
              <div class="main-area-three">
                <label>
                        <span class="label">Housing Feature</span>
                   <div class="select-event">Click here to select</div>
                </label>
                <div class="event_cat" style="display:block;">
  <label>
  <input type="hidden" name="housing_wanted" value="" />
  <input type="checkbox" value="yes" name="housing_wanted" />housing wanted
  </label>
  <label>
  <input type="hidden" name="housing_offered" value="" />
  <input type="checkbox" value="yes" name="housing_offered"/>housing offered
  </label>              
                
<label class="std ">
<input type="hidden" name="wheelchaccess" value="" />
<input tabindex="1" type="checkbox" value="yes" name="wheelchaccess">wheelchair accessible</label>
<label>
<input type="hidden" name="no_smoking" value="" />
<input type="checkbox" value="yes" name="no_smoking">no smoking
</label>
<label>
<input type="hidden" name="private_bath" value="" />
<input type="checkbox" value="yes" name="private_bath">private bath
</label>
<label>
<input type="hidden" name="private_room" value="" />
<input type="checkbox" value="yes" name="private_room">private room
</label>
<label>
<input type="hidden" name="pets_cat" value="" />
<input type="checkbox" name="pets_cat" value="cats accepted">cats accepted
</label>
<label>
<input type="hidden" name="pets_dog" value="" />
<input type="checkbox" name="pets_dog" value="dogs accepted">dogs accepted
</label>
<!--<label> <input tabindex="1" type="checkbox" id="oc" name="contact_ok" value="ok">
    ok for others to contact you about other services, products or commercial interests
</label>-->
</div>
</div>
           

            

            
<div id="uploader">
<h5 class="upl">Upload House Images</h5><br />
<input name="post_images[]" type="file" id="uploader" multiple="multiple">
<em> you can select multiple image by pressing Ctrl</em>
</div>
        </div>
 <input type="hidden" name="cat_id" value="<?php echo $child_id?>"/>         
       <input type="submit" value="Create Post Preview" name="submtadd"/>
        
<?php echo form_close();?>

</section>
</article>
</div>