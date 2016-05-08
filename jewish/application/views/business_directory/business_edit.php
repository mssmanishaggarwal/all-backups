<script>console.log('view/business_directory/business_edit.php');</script>
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/business.css">
<script src="<?php echo JEWISH_URL;?>/js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
<div class="container">
 <article class="page-content">
  <ul class="page-nav">
    <li><a href="<?php echo JEWISH_URL;?>">homepage></a></li>
    <li><a href="<?php echo JEWISH_URL;?>/business_directory/business_edit/<?php echo $this->uri->segment(3)?>">Edit Your Business</a></li>
  </ul>
<script>
$(document).ready(function(e) {
 $("#b_phone").mask("(999) 999-9999");   
});

</script>
<?php
$bd_post=$this->businessmod->fetch_bdpost_id($bd_id);
/*echo '<pre>';
print_r($bd_post);
echo '</pre>';*/?>
<div style="clear:both;"></div>
<section class="page-event">
<h1 class="add_heading">Edit Your Business</h1>
<div class="yform">
<?php $attributes = array('id' => 'add_business');
                   echo form_open_multipart('business_directory/business_update', $attributes);
				   ?>
<div class="yformer">
<input type="hidden" name="id" value="<?php echo $this->allencode->encode($bd_post[0]['id'])?>"/>
<label for="biz_name">Business Name</label>
<input maxlength="64" name="b_name" id="b_name" type="text" placeholder="Mel's Diner" value="<?php echo $bd_post[0]['b_name']?>" required>
<label for="biz_address1">Address 1</label>
<input maxlength="64" name="b_address1" id="b_address1"  type="text" placeholder="123 Main Street" value="<?php echo $bd_post[0]['b_address1']?>">
<label for="biz_address2">Address 2</label>
<input maxlength="64" name="b_address2" id="b_address2" type="text" placeholder="Suite 200" value="<?php echo $bd_post[0]['b_address2']?>">
        <label for="biz_city">City</label>
        <select name="b_city" class="city_selecte">
      <option value="">Select City</option>
      <?php $get_city=$this->citymod->fetch_city();
	  foreach($get_city as $v){?>
      <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
      <?php }?>
      </select>
        <label for="biz_state">State</label>
        <input maxlength="2" name="b_state" id="biz_state" type="text" placeholder="CA" value="<?php echo $bd_post[0]['b_state']?>">
 </div><div class="yformer">
        <label for="biz_zip">ZIP</label>
        <input maxlength="12" name="b_zipcode" id="biz_zip" type="text" placeholder="94103" value="<?php echo $bd_post[0]['b_zipcode']?>">
    <label for="biz_phone">Phone</label>
    <input maxlength="32" name="b_phone" id="b_phone" type="text" placeholder="(555) 555-5555" value="<?php echo $bd_post[0]['b_phone']?>"  pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}" required="required">
    <label for="biz_website">Web Address</label>
    <input maxlength="2000" name="b_url" id="b_url" type="text" placeholder="http://www.companyaddress.com" value="<?php echo $bd_post[0]['b_url']?>">
    <label for="categories">Categories</label>
    <select name="b_cat_id" id="b_cat_id" required>
    <?php $data=$this->businessmod->fetch_category();
     foreach($data as $v){?>
    <option value="<?php echo $v['id']?>"><?php echo $v['category_name']?></option>
    <?php } ?>
    </select>
    <label for="email">Your Email Address</label>
    <input maxlength="64" name="b_email" type="email" value="<?php echo $bd_post[0]['b_email']?>" required>
    </div>
    <div style="clear:both;"></div>
    <label for="email" id="b_des_lebel">Your Business Description</label>
    <textarea name="b_des" rows="5" cols="50" id="b_des" style="height:200px;"><?php echo $bd_post[0]['b_des']?></textarea>
    <label for="email" id="b_des">Upload Multiple Business Images</label></br>
    <input name="post_images[]" type="file" id="uploader b_des" multiple="multiple" style="margin-left:15px;">
<em> you can select multiple image by pressing Ctrl</em></br>
<p>&nbsp;</p>
    <input type="submit" name="b_submit" value="Submit" id="b_submit"/>
<?php echo form_close(); ?>
 </div>  
</section>
 <div class="clear"></div>
 </article>
</div>
 <script>
$(document).ready(function() {
	 $( "#b_cat_id option[value='<?php echo $bd_post[0]['b_cat_id']?>']" ).attr('selected','selected');
	  $( ".city_selecte option[value='<?php echo $bd_post[0]['b_city']?>']" ).attr('selected','selected');
	  
	
	 });
</script>