<script>console.log('view/job/addpost.php')</script>
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/addpost.css">

<script src="<?php echo JEWISH_URL;?>/js/jquery.maskedinput.js" type="text/javascript"></script>

<div class="container"> 

<article class="page-content">

<ul class="page-nav">

    <li><a href="<?php echo JEWISH_URL;?>">Homepage</a></li>

    <li> > <a href="<?php echo JEWISH_URL;?>/classified/search/job/">Job</a></li>

    <li> > <a href="<?php echo JEWISH_URL;?>/post/addjobpost/">Add Post</a></li>

  </ul>

  <?php /*?><?php if(empty($child_id)){

	redirect();

	 } ?><?php */?>

<script>

$(document).ready(function() {

    <?php /* if(empty($child_id)){?>

	history.back(1);

	<?php }*/ ?>

	$('.select-event').on('click',function(){

	$('.event_cat').slideToggle(500);

	$('.select-event').css({'border':'1px solid #bbb','color':''});

	});

	  /*$('#addpost').submit(function(kaushik){

	var fields=$('.event_cat').find('input[type="checkbox"]:checked');

    if (fields.length== 0) 

    { 

        $('.select-event').css({'border':'3px solid red','color':'red'});

		$('.select-event').html('Select at least one Job Feature, Click Here');

       kaushik.preventDefault(); 

    } 



	});*/

	$("#contact_phone").mask("(999) 999-9999");

		 $('Select option').each(function(){

      $(this).text($(this).text().charAt(0).toUpperCase() + $(this).text().slice(1));

    });

});

</script> 

<?php //echo $parent_id.'---'.$child_id;?> 

<section class="body">

<?php $attributes = array('id' => 'addpost');

                   echo form_open_multipart('post/jobinsert/', $attributes);

				   ?>

        <div class="posting fields">

           

                

<div class="main-area">Contact Information</div>

                    <div class="top-area">

                             <label >

                            <div class="label">Your Name</div>

                            <input type="text" value="" name="contact_name" id="contact_name" size="16" maxlength="32" tabindex="1">

                        </label>          

                             <label >

                            <div class="label">Phone</div> 

<input type="text" class="std" value=""  pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}" name="contact_phone" id="contact_phone" size="10" maxlength="16" tabindex="1" placeholder="(555) 555-1212" >

                        </label>   

                    </div>

                    <div class="top-area">            

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

    <?php /*?><input type="hidden" value="<?php echo $child_id;?>" name="object_id"  />  <?php */?>

                    

                    <!--<span id="oiab">

<label title="craigslist will anonymize your email address">

    <input type="radio" name="Privacy" value="C" checked="" tabindex="1">

    CL mail relay <small>(recommended)</small>

    <sup>[<a title="how does mail relay work?" target="_blank" href="http://www.craigslist.org/about/help/email-relay">?</a>]</sup>

</label>





            <label title="your actual email address will appear in the posting">

                <input type="radio" name="Privacy" value="P" id="P" tabindex="1">

                show my real email address 

            </label>

        



<label title="no email address will appear in your posting - be sure to include other contact info!">

    <input type="radio" name="Privacy" value="A" id="A" tabindex="1">

    no replies to this email

</label>

</span>-->

               

             



<!--    <div class="label">users can also contact me:

    <label><input name="contact_phone_ok" id="contact_phone_ok" type="checkbox" value="1">by phone</label>

    <label><input name="contact_text_ok" id="contact_text_ok" type="checkbox" value="1">by text</label></div>-->

<p>&nbsp;</p>

<p>&nbsp;</p>

             <span id="main-area">Job Details</span>

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

                <div class="top-area">

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

                        <span class="label">Your Job Description</span>

                    <textarea class="req" tabindex="1" rows="10" id="PostingBody" name="post_content" required="required"></textarea>

                </label>

                <label ><span class="label">Compensation</span>

                <input type="text" class="" size="80" id="compensation" name="compensation" >

                </label>

				</div>

           



         <div class="main-area-three">

                <label>

                        <span class="label">Job Feature</span>

                   <div class="select-event">Click here to select</div>

                </label>

                <div class="event_cat" style="display:block;">

   <label>

   <input type="hidden" name="job_wanted" value="" />

   <input tabindex="1" type="checkbox" value="yes" name="job_wanted">job wanted</label>

  <label>

  <input type="hidden" name="job_offered" value="" />

  <input tabindex="1" type="checkbox" value="yes" name="job_offered">job offered</label>

       <?php /*?> <label>

        <input type="hidden" name="telecom" value="" />

    <input tabindex="1" type="checkbox" id="tc" name="telecom" value="yes">

        telecommuting ok</label>

    <label>

     <input type="hidden" name="part-time" value="" />

    <input tabindex="1" type="checkbox" id="pt" name="part-time" value="yes">

        part-time</label>

    <label>

    <input type="hidden" name="contract" value="" />

    <input tabindex="1" type="checkbox" id="ct" name="contract" value="yes">

        contract</label>

    <label>

    <input type="hidden" name="non-profit" value="" />

    <input tabindex="1" type="checkbox" id="np" name="non-profit" value="yes">

        non-profit organization</label>

    <label>

    <input type="hidden" name="internship" value="" />

    <input tabindex="1" type="checkbox" id="in" name="internship" value="yes">

        internship</label>

<br>

    <label>

    <input type="hidden" name="direct_contact" value="" />

    <input tabindex="1" type="checkbox" id="ro" name="direct_contact" value="ok">

        direct contact by recruiters is ok</label>

<br>

    <label>

    <input type="hidden" name="disabilities" value="" />

        <input tabindex="1" type="checkbox" name="disabilities" value="ok"> 

        ok to highlight this job opening for persons with disabilities

        </label><?php */?>

            </div>

            </div>



            



     

            

            <div id="uploader">

            <h5 class="upl">Upload Job Related Images</h5><br />

<input name="post_images[]" type="file" id="uploader" multiple="multiple">

<em> you can select multiple image by pressing Ctrl</em>

</div>

        </div>

 <input type="hidden" name="cat_id" value="<?php echo $child_id?>"/>         

       <input type="submit" value="Create Post Preview" name="submtadd"/>

        

<?php echo form_close(); ?>



</section>

</article>

</div>