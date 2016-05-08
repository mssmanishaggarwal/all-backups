<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/business.css">
<script>console.log('view/business_directory/add_business.php');</script>
<script src="<?php echo JEWISH_URL;?>/js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
<div class="container">
 <article class="page-content">
  <ul class="page-nav">
    <li><a href="<?php echo JEWISH_URL;?>">homepage></a></li>
    <li><a href="<?php echo JEWISH_URL;?>/business_directory/add_business/<?php echo $this->uri->segment(3)?>">Add Your Business</a></li>
  </ul>
<script>
$(document).ready(function(e) {
 $("#b_phone").mask("(999) 999-9999");   
});

</script>
<!--<ul class="page-alpha">
 <li>Categories as alphabetic</li>
 <li><a href="#">A</a></li>
 <li><a href="#">B</a></li>
 <li><a href="#">C</a></li>
 <li><a href="#">D</a></li>
 <li><a href="#">E</a></li>
 <li><a href="#">F</a></li>
 <li><a href="#">G</a></li>
 <li><a href="#">H</a></li>
 <li><a href="#">I</a></li>
 <li><a href="#">J</a></li>
 <li><a href="#">K</a></li>
 <li><a href="#">M</a></li>
 <li><a href="#">N</a></li>
 <li><a href="#">O</a></li>
 <li><a href="#">P</a></li>
 <li><a href="#">Q</a></li>
 <li><a href="#">R</a></li>
 <li><a href="#">S</a></li>
 <li><a href="#">T</a></li>
 <li><a href="#">U</a></li>
 <li><a href="#">V</a></li>
 <li><a href="#">W</a></li>
 <li><a href="#">X</a></li>
 <li><a href="#">Y</a></li>
 <li><a href="#">Z</a></li>
</ul>
<ul class="alpha-heading">
<li>A</li>
<li>Attorneys</li>
</ul>-->
<div style="clear:both;"></div>
<section class="page-event">
<h1 class="add_heading">Add Your Business</h1>
<div class="yform">
<?php $attributes = array('id' => 'add_business');
                   echo form_open_multipart('business_directory/business_insert', $attributes);
				   ?>
<div class="yformer">
<label for="biz_name">Business Name</label>
<input maxlength="64" name="b_name" id="b_name" type="text" placeholder="Mel's Diner" required>
<label for="biz_address1">Address 1</label>
<input maxlength="64" name="b_address1" id="b_address1"  type="text" placeholder="123 Main Street" class="">
<label for="biz_address2">Address 2</label>
<input maxlength="64" name="b_address2" id="b_address2" type="text" placeholder="Suite 200" class="">
        <label for="biz_city">City</label>
        <select name="b_city" class="city_select">
      <option value="">Select City</option>
      <?php $get_city=$this->citymod->fetch_city();
	  foreach($get_city as $v){?>
      <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
      <?php }?>
      </select>
        <label for="biz_state">State</label>
        <input maxlength="2" name="b_state" id="biz_state" type="text" placeholder="CA" class="">
 </div><div class="yformer">
        <label for="biz_zip">ZIP</label>
        <input maxlength="12" name="b_zipcode" id="biz_zip" type="text" placeholder="94103" class="">
    <label for="biz_phone">Phone</label>
    <input maxlength="32" name="b_phone" id="b_phone" type="text" placeholder="(555) 555-5555" class="" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}" required="required">
    <label for="biz_website">Web Address</label>
    <input maxlength="2000" name="b_url" id="b_url" type="text" placeholder="http://www.companyaddress.com" class="">
    <label for="categories">Categories</label>
    <select name="b_cat_id" id="b_cat_id" required>
    <?php $data=$this->businessmod->fetch_category();
     foreach($data as $v){?>
    <option value="<?php echo $v['id']?>"><?php echo $v['category_name']?></option>
    <?php } ?>
    </select>
    <label for="email">Your Email Address</label>
    <input maxlength="64" name="b_email" type="email" required>
    </div>
    <div style="clear:both;"></div>
    <label for="email" id="b_des_lebel">Your Business Description</label>
    <textarea name="b_des" rows="5" cols="50" id="b_des"></textarea>
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