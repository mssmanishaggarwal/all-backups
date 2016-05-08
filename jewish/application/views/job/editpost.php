<script>console.log('view/job/editpost.php')</script>
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/addpost.css">

<script src="<?php echo JEWISH_URL;?>/js/jquery.maskedinput.js" type="text/javascript"></script>

<div class="container"> 

<article class="page-content">

<ul class="page-nav">

    <li><a href="<?php echo JEWISH_URL;?>">Homepage</a></li>

    <li> > <a href="<?php echo JEWISH_URL;?>/post/post_edit/<?php echo $this->uri->segment(3)?>/<?php echo $this->uri->segment(4)?>">Edite Job Post</a></li>

  </ul>

<?php //echo $email;

//echo $p_id;?>

<section class="body">

<?php $attributes = array('id' => 'addpost');

                   echo form_open_multipart('post/job_postupdate/', $attributes);

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

<input type="text" class="str" value="<?php echo $data[0]['contact_phone']?>" name="contact_phone" id="contact_phone" size="10" maxlength="16" tabindex="1" required="required" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}">

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

<?php /*?><input type="hidden" name="object_id" value="<?php echo $this->postmod->get_catid_by_postid($p_id);?>"  /> 

<input type="hidden" name="cat_id" value="<?php echo $this->postmod->get_catid_by_postid($p_id);?>"  />          <?php */?>  

<script>

 $(document).ready(function() {

    $(".city_selectr option[value='<?php echo $data[0]['geo_area']?>']").attr('selected','selected');

		$('.select-event').on('click',function(){

	$('.event_cat').slideToggle(500);

	$('.select-event').css({'border':'1px solid #bbb','color':''});

	});

	  $('#addpost').submit(function(kaushik){

	var fields=$('.event_cat').find('input[type="checkbox"]:checked');

    if (fields.length== 0) 

    { 

        $('.select-event').css({'border':'3px solid red','color':'red'});

		$('.select-event').html('Select at least one Job Feature, Click Here');

       kaushik.preventDefault(); 

    } 



	});

	$("#contact_phone").mask("(999) 999-9999");

		 $('Select option').each(function(){

      $(this).text($(this).text().charAt(0).toUpperCase() + $(this).text().slice(1));

    });

});

 </script>  

 <p>&nbsp;</p>

<p>&nbsp;</p>

             <span id="main-area">Job Details</span>

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

       <input type="text" id="postal_code" name="zipcode" size="6" maxlength="15" value="<?php echo $data[0]['zipcode']?>" required="required">

                </label>

              </div>  

              <div class="main-area-three">

                       <label> <div class="label">State</div>

                 <input tabindex="1" type="text" name="state" id="PostingTitle" maxlength="70"  required="required" value="<?php echo $data[0]['state']?>">

                        </label>

                </div>

            <div style="clear:both;"></div>

<?php  

                   $this->db->select('*');

				   $this->db->where('post_id', $p_id );

				   $query = $this->db->get('job_post_meta');

				   $data3 = $query->result_array();

				   //echo $this->db->last_query();

?>

            <div class="main-area-three">

                <label >

                        <span class="label">Your Job Description</span>

                    <textarea class="req" tabindex="1" rows="10" id="PostingBody" name="post_content" required="required"><?php echo $data[0]['post_content']?></textarea>

                </label>

                </div>

           <div class="main-area-three" style="margin-top: 144px;">     

                <label >

                        <span class="label">Compensation</span>

                     <input type="text"  size="80" id="compensation" name="compensation" value="<?php echo $data3[0]['compensation']?>" required="required">

            	 </label>

			</div>



 <div style="clear:both;"></div>

        

    

         <div class="main-area-three">

                <label>

                        <span class="label">Job Feature</span>

                   <div class="select-event">Click here to select</div>

                </label>

                <div class="event_cat" style="display:block;">

   <label>

   <input type="hidden" name="job_wanted" value="" />

   <input tabindex="1" type="checkbox" value="yes" name="job_wanted" <?php if($data3[0]['job_wanted']=='yes'){

	echo 'checked';

}?>>job wanted</label>

  <label>

  <input type="hidden" name="job_offered" value="" />

  <input tabindex="1" type="checkbox" value="yes" name="job_offered" <?php if($data3[0]['job_offered']=='yes'){

	echo 'checked';

}?>>job offered</label>                

<?php /*?><label>

  <input type="hidden" name="telecom" value="" />

    <input tabindex="1" type="checkbox" id="tc" name="telecom" value="yes" <?php if($data3[0]['telecom']=='yes'){

	echo 'checked';

}?>>

        telecommuting ok</label>

    <label>

    <input type="hidden" name="part-time" value="" />

    <input tabindex="1" type="checkbox" id="pt" name="part-time" value="yes" <?php if($data3[0]['part-time']=='yes'){

	echo 'checked';

}?>>

        part-time</label>

    <label>

    <input type="hidden" name="contract" value="" />

    <input tabindex="1" type="checkbox" id="ct" name="contract" value="yes" <?php if($data3[0]['contract']=='yes'){

	echo 'checked';

}?>>

        contract</label>

    <label>

    <input type="hidden" name="non-profit" value="" />

    <input tabindex="1" type="checkbox" id="np" name="non-profit" value="yes" <?php if($data3[0]['non-profit']=='yes'){

	echo 'checked';

}?>>

        non-profit organization</label>

    <label>

     <input type="hidden" name="internship" value="" />

    <input tabindex="1" type="checkbox" id="in" name="internship" value="yes" <?php if($data3[0]['internship']=='yes'){

	echo 'checked';

}?>>

        internship</label>



    <label>

    <input type="hidden" name="direct_contact" value="" />

    <input tabindex="1" type="checkbox" id="ro" name="direct_contact" value="ok" <?php if($data3[0]['direct_contact']=='ok'){

	echo 'checked';

}?>>

        direct contact by recruiters is ok</label>



    <label>

    <input type="hidden" name="disabilities" value="" />

        <input tabindex="1" type="checkbox" name="disabilities" value="ok" <?php if($data3[0]['disabilities']=='ok'){

	echo 'checked';

}?>> 

        ok to highlight this job opening for persons with disabilities

        </label><?php */?>



 </div>

 </div>        

       

            

            <div id="uploader">

            <h5 class="upl">Update Job Images</h5><br />

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

                      url: '<?php echo JEWISH_URL;?>'+'/post/delete_image/?ded='+getval+'&imgurl='+imgname,

                      type: 'POST',

                      success: function(data){

						  			

									alert('Image Deleted');

									location.reload();

		                    				// $(".list-v").html(data)

									

                             }

                  });



			})

	});

</script>

<div class="uploaded">

<h1>Uploaded Image</h1>



<?php

 

                   $this->db->select('*');

				   $this->db->where('post_id', $p_id );

				   $query = $this->db->get('images');

				   $data2 = $query->result_array();

				   //echo $this->db->last_query();

					foreach( $data2 as $l ){

?>

<img src="<?php echo JEWISH_URL;?>/upload/<?php echo $l['img']?>"  height="200" width="200" /><a href="#" data="<?php echo $l['img']?>" name="<?php echo $l['id'];?>" title="Delete this Image"><span class="del">X</span>

</a><?php } ?>



  </div> 

  <p>&nbsp;</p>       

       <input type="submit" value="Update this post" name="submtadd"/>

 

        </div>       

<?php echo form_close(); ?>



</section>

</article>

</div>