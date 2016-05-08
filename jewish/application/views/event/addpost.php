<script>console.log('view/event/addpost.php');</script>
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/addpost.css">

<script src="<?php echo JEWISH_URL;?>/js/jquery.maskedinput.js" type="text/javascript"></script>

<?php /*?><link rel="stylesheet" type="text/css" href="<?php echo JEWISH_URL;?>/js/jquery.multiselect.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php echo JEWISH_URL;?>/assets/prettify.js"></script>

<script type="text/javascript" src="<?php echo JEWISH_URL;?>/js/jquery.multiselect.js"></script><?php */?>

<?php //echo 'Event';?>

<?php //echo $parent_id.'---'.$child_id;?>



<?php  $now = new \DateTime('now');$year=$now->format('Y');

															$day=$now->format('j');

                                                           $month=str_replace('0','',$now->format('m'));

														?>

<script>

$(document).ready(function() {

    <?php /*if(empty($child_id)){?>

	history.back(1);

	<?php }*/ ?>

	//$("#sl").multiselect();

//$('.ui-multiselect-close >a >span').html('Close');

$('.select-event').on('click',function(){

	$('.event_cat').slideToggle(500);

	$('.select-event').css({'border':'1px solid #bbb','color':''});

	});

  

/*  $('#addpost').submit(function(kaushik){

	var fields=$('.event_cat').find('input[type="checkbox"]:checked');

    if (fields.length== 0) 

    { 

        $('.select-event').css({'border':'3px solid red','color':'red'});

		$('.select-event').html('Select at least one Event Fature, Click Here');

       kaushik.preventDefault(); 

    } 



	});*/

	$("#contact_phone").mask("(999) 999-9999");

		 $('Select option').each(function(){

      $(this).text($(this).text().charAt(0).toUpperCase() + $(this).text().slice(1));

    });

		$( "#event_year option[value='<?php echo $year;?>']" ).attr('selected','selected');

	$( "#start_month option[value='<?php  echo $month;?>']" ).attr('selected','selected');

});

</script> 

<div class="container"> 



<article class="page-content">

<ul class="page-nav">

    <li><a href="<?php echo JEWISH_URL;?>">Homepage</a></li>  

    <li> > <a href="<?php echo JEWISH_URL;?>/classified/search/event/">Event</a></li>

    <li> > <a href="<?php echo JEWISH_URL;?>/post/addeventpost/">Add Post</a></li>

  </ul>

<section class="body">

<?php $attributes = array('id' => 'addpost');

                   echo form_open_multipart('post/eventinsert/', $attributes);

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

                   



   <!-- <div class="label">users can also contact me:

    <label><input name="contact_phone_ok" id="contact_phone_ok" type="checkbox" value="1">by phone</label>

    <label><input name="contact_text_ok" id="contact_text_ok" type="checkbox" value="1">by text</label></div>-->

           
                <span  id="main-area" class="main-add-post">Event Details</span>

				<div class="main-area-two">

                   <label class="event-date">

                      <div class="label">Start Date</div>

                    <input min="1" max="31" type="number" name="start_date" value="<?php echo $day;?>" class="sp2" required="required" style="height:31px;margin-top:0px;">

            	</label>

         		

                   <label> <div class="label">Start Month</div>

                    <select name="start_month" required="required" id="start_month">

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

             </label>

             		<label> <div class="label">Event Year</div>

                    <select name="event_year" id="event_year">

                    <?php for($i=2015;$i<=2025;$i++){?>

                    <option value="<?php echo $i;?>"><?php echo $i;?></option>

                    <?php } ?>

                    </select> 

                    </label>

   

                   <label> <div class="label">Event Duration</div>

        

  

            

                <select name="event_duration">

                    <option value="1">1 day</option>

                    <option value="2">2 days</option>

                    <option value="3">3 days</option>

                    <option value="4">4 days</option>

                    <option value="5">5 days</option>

                    <option value="6">6 days</option>

                    <option value="7">7 days</option>

                    <option value="8">8 days</option>

                    <option value="9">9 days</option>

                    <option value="10">10 days</option>

                    <option value="11">11 days</option>

                    <option value="12">12 days</option>

                    <option value="13">13 days</option>

                    <option value="14">14 days</option>

                </select> 

            </label>

        

            	</div>


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

                        <span class="label">Your Event Description</span>

                    <textarea class="req" tabindex="1" rows="10" id="PostingBody" name="post_content" required="required"></textarea>

                </label>

				</div>

                <div class="main-area-three">

                <label>

                        <span class="label">Event Feature</span>

                   <div class="select-event">Click here to select</div>

                </label>

                <div class="event_cat" style="display:block;">

        <label class="std event_attr_label" for="event_art" style="min-width: 167px;">

        <input type="hidden" name="event_advertisement" value="" />

        <input id="event_art" class="event_attr" type="checkbox" value="yes" name="event_advertisement">Event Advertisement</label>        

        <label class="std event_attr_label" for="event_art" style="min-width: 167px;">

        <input type="hidden" name="event_art" value="" />

        <input id="event_art" class="event_attr" type="checkbox" value="yes" name="event_art">Art/Film</label>

         <label class="std event_attr_label" for="event_career" style="min-width: 167px;">

         <input type="hidden" name="event_career" value="" />

         <input id="event_career" class="event_attr" type="checkbox" value="yes" name="event_career">career</label> 

         <label class="std event_attr_label" for="event_fundraiser_vol" style="min-width: 167px;">

          <input type="hidden" name="event_charitable" value="" />

         <input id="event_fundraiser_vol" class="event_attr" type="checkbox" value="yes" name="event_charitable">Charity</label>

          <label class="std event_attr_label" for="event_athletics" style="min-width: 167px;">

          <input type="hidden" name="event_competition" value="" />

          <input id="event_athletics" class="event_attr" type="checkbox" value="yes" name="event_competition">Competition</label> 

          <label class="std event_attr_label" for="event_dance" style="min-width: 167px;">

          <input type="hidden" name="event_dance" value="" />

          <input id="event_dance" class="event_attr" type="checkbox" value="yes" name="event_dance">Dance</label> 

          <label class="std event_attr_label" for="event_festival" style="min-width: 167px;">

          <input type="hidden" name="event_festival" value="" />

          <input id="event_festival" class="event_attr" type="checkbox" value="yes" name="event_festival">Festival/Fair</label> 

          <label class="std event_attr_label" for="event_fitness_wellness" style="min-width: 167px;">

          <input type="hidden" name="event_fitness_wellness" value="" />

          <input id="event_fitness_wellness" class="event_attr" type="checkbox" value="yes" name="event_fitness_wellness">Fitness/Health</label> 

          <label class="std event_attr_label" for="event_food" style="min-width: 167px;">

          <input type="hidden" name="event_food" value="" />

          <input id="event_food" class="event_attr" type="checkbox" value="yes" name="event_food">Food/Drink</label> 

          <!--<label class="std event_attr_label" for="event_free" style="min-width: 167px;">

          <input id="event_free" class="event_attr" type="checkbox" value="yes" name="event_free">free</label>-->

           <label class="std event_attr_label" for="event_kidfriendly" style="min-width: 167px;">

           <input type="hidden" name="event_kidfriendly" value="" />

           <input id="event_kidfriendly" class="event_attr" type="checkbox" value="yes" name="event_kidfriendly">Kid Friendly</label> 

           <label class="std event_attr_label" for="event_literary" style="min-width: 167px;">

           <input type="hidden" name="event_literary" value="" />

           <input id="event_literary" class="event_attr" type="checkbox" value="yes" name="event_literary">Literary</label> 

           <label class="std event_attr_label" for="event_music" style="min-width: 167px;">

           <input type="hidden" name="event_music" value="" />

           <input id="event_music" class="event_attr" type="checkbox" value="yes" name="event_music">Music</label>

            <label class="std event_attr_label" for="event_outdoor" style="min-width: 167px;">

             <input type="hidden" name="event_outdoor" value="" />

            <input id="event_outdoor" class="event_attr" type="checkbox" value="yes" name="event_outdoor">Outdoor</label>

             <!--<label class="std event_attr_label" for="event_sale" style="min-width: 167px;">

             <input id="event_sale" class="event_attr" type="checkbox" value="yes" name="event_sale">sale</label>--> 

             <label class="std event_attr_label" for="event_singles" style="min-width: 167px;">

             <input type="hidden" name="event_singles" value="" />

             <input id="event_singles" class="event_attr" type="checkbox" value="yes" name="event_singles">Singles</label> 

             <label class="std event_attr_label" for="event_geek" style="min-width: 167px;">

             <input type="hidden" name="event_geek" value="" />

             <input id="event_geek" class="event_attr" type="checkbox" value="yes" name="event_geek">Technology</label>

            </div>

            </div>

           

   



            <div class="row fields">

<p>&nbsp;</p>            

            <div id="uploader">

            <h5 class="upl">Upload your Event Images</h5><br />

<input name="post_images[]" type="file" id="uploader" multiple="multiple">

<em> you can select multiple image by pressing Ctrl</em>

</div>

        </div>

        </div>

 <input type="hidden" name="cat_id" value="<?php echo $child_id?>"/>         

       <input type="submit" value="Create Post Preview" name="submtadd"/>

        

<?php echo form_close(); ?>



</section>

</article>

</div>