<script>
 $(document).ready(function(){
	// alert('dsfsdaff');
   $(".comreply").click(function(){
   $(".comrdesc").hide();	   
   var comre=$(this).attr('id');
   $('.'+comre).toggle('slow');
   
 	  });	
	
//	$('.myform').click(function(e){
//		alert($(this).attr('title'));
//		var did = $(this).attr('title');
//		e.preventDefault();
// 		var kdd = $("#"+did).serialize();
//		alert(kdd);
//           var dataString = kdd;	
//		 alert(dataString);		
//		 alert("<?php echo site_url('forum/productreviews'); ?>");					
//            $.post("<?php echo site_url('forum/productreviews'); ?>", dataString,
//   function(data){
//	   alert(data);
//    $('#loading').hide();
//	 $("#body_cont_inner_right").html(data);
//    });
//		
//		
//		
//		
//		
//		
//		$.ajax({
//		type: 'post',
//		url: "<?php echo site_url('productreviews'); ?>",
//		data: $("#"+did).serialize(),
//		success: function () {
//		alert('form was submitted');
//		$('.success').fadeIn(200).show();
//		$('.error').fadeOut(200).hide();
//		$('.signupform').fadeOut(200).hide();
//		//$("#preview_form").resetForm();
// 		$('.replysubmit').each(function(){
//		this.reset(); //Here form fields will be cleared.
//		});
//		}
//		});
		
//		});
	  
//	$("form").on('submit', function (e) {
//		alert($(".myform").attr('title'));
// 		e.preventDefault();
//		var kdd = $("form").serialize();
//		alert(kdd);
//		$.ajax({
//		type: 'post',
//		url: "<?php echo site_url('productreviews'); ?>",
//		data: $('form').serialize(),
//		success: function () {
//		alert('form was submitted');
//		$('.success').fadeIn(200).show();
//		$('.error').fadeOut(200).hide();
//		$('.signupform').fadeOut(200).hide();
//		//$("#preview_form").resetForm();
// 		$('.replysubmit').each(function(){
//		this.reset(); //Here form fields will be cleared.
//		});
//		}
//		});
// 	});	  
 	 
 });




</script>



 <div class="container">
 <div class="content-left">
<?php
  if(!$this->uri->segment(3)){
	  
?>
 <section class="forums-post">  
 <?php
  // echo $this->uri->segment(3);
 if($forumdata>0){
    foreach($forumdata as $ky=>$val)
  {
  ?> 
  <ul>

  <?php
   for($i=0;$i<sizeof($forumdata[$ky]);$i++)
  {
 	    ?>
  
  
       <li><figure class="thum2"><img width="50" height="50" src="<?php echo JEWISH_URL;?>/upload/<?php echo $forumdata[$ky][$i]['forum_author_image'] ; ?>" alt=""></figure>
       <h4><a href="<?php echo JEWISH_URL;?>/forum/<?php echo strtolower($ky); ?>/<?php echo $forumdata[$ky][$i]['forum_slug'] ; ?>"><?php echo $forumdata[$ky][$i]['forum_name'] ; ?></a><br><span><?php echo strtolower($ky); ?></span></h4>
       <h5><span><?php  echo $forumdata[$ky][$i]['forumcomment_count'] ;?></span><?php  echo $forumdata[$ky][$i]['forum_modified_date'] ;?></h5>
       </li>
       <?php }?>
    </ul>
        <?php }}else{ ?>
 <p>Sorry no threads found.</p>
       <?php } ?>
</section>
<?php } 
 if($this->uri->segment(3)){
	  $user_log=$this->session->userdata('logged_in');
 	 ?>
<section class="community-area">
 <p class="qus"><?php echo $forumdata['forum_name'];?></p>
  <h3><?php echo $forumdata['forum_name'];?></h3>
 <article class="blog">
  <figure class="thum1"><img width="80" src="<?php echo JEWISH_URL;?>/upload/<?php echo $forumdata['forum_author_image'] ; ?>" alt=""></figure>
  <div class="blog-right">
   <h5><span><?php  echo $forumdata['forum_author'];  ?></span> &nbsp; <?php echo $forumdata['forum_modified_date'] ; ?>  <i>edited</i></h5>
   <p><?php echo $forumdata['forum_content'];?></p>
   <h6><a href="#">Translate</a></h6>
  </div>
 </article>
 
 <h2><span><?php echo sizeof($forumcomment); ?></span>Responses</h2>
 <div class="borderunder"></div>
 <?php 
  if($this->uri->segment(3)){
      for($i=0;$i<sizeof($forumcomment);$i++)
  {
  ?>
 
    <article style="border:0px" class="blog">
        <figure class="thum1">
        <img width="40" src="<?php if($forumcomment[$i]['forum_author_image'])
		{echo $forumcomment[$i]['forum_author_image'];}else{ echo JEWISH_URL;?>/upload/nouser.png<?php }?>" alt=""></figure>
        <div class="blog-right">
            <h5><span><?php echo $forumcomment[$i]['fcomment_name']; ?></span> </h5>
            <p><?php echo $forumcomment[$i]['fcomment_desc']; ?></p>
            <p id="comrply<?php echo $i; ?>" class="comreply">Reply <img src="<?php echo JEWISH_URL;?>/images/arrow-d.png" /></p>
        </div>
    </article>
       <?php
		if(isset($user_log['user_id'])){
			//print_r($user_log);
	  ?>

        <div style="display:none" class="commentrespond comrdesc comrply<?php echo $i; ?>">
            <form action="" id="replysubmit<?php echo $i;?>"  method="post">
                <p class="comment-form-author">
                <!--                <label for="author">Name <span class="required">*</span></label><br />
                --><input id="author" name="reply_name" class="reply_name" type="hidden" value="<?php echo $user_log['username'];?>" size="30" aria-required="true">
                </p>
                
                <p class="comment-form-email">
                <!--<label for="email">Email <span class="required">*</span></label> <br />
                --><input id="email" name="reply_email"  class="reply_email" type="hidden" value="<?php echo $user_log['email'];  ?>" size="30" aria-required="true">
                </p>
                <input type="hidden" name="fcomment_id" class="fcomment_id"  value="<?php echo $forumcomment[$i]['fcomment_id']; ?>" /> 
                <p class="comment-form-comment">
                <label for="comment">Comment</label><br />
                <textarea id="comment" required='required' name="reply_desc" class="reply_desc" cols="45" rows="8" aria-required="true"></textarea>
                </p>						 
                                                    
                <p class="form-submit">
                <input name="replysubmit"  class="myform" title="replysubmit<?php echo $i;?>" type="submit" id="submit" value="Post Comment">
                </p>
            </form>
        </div>         
 
 
   <?php } ?>
   
   <?php
   if($forumcomment[$i]['fcomment_reply']){
    $rp = unserialize($forumcomment[$i]['fcomment_reply']);
   for($j=0;$j<sizeof($rp);$j++){	   
   ?>
    <article style="border:0px; margin-left:90px; padding-bottom:15px; border-bottom:1px #f1f1f1 solid;" class="blog">
        <figure class="thum1">
        <img width="40" src="<?php //if($rp[$i]['forum_author_image'])
		//{echo $rp[$i]['forum_author_image'];}else{ 
		echo JEWISH_URL;?>/upload/nouser.png<?php //}?>" alt=""></figure>
        <div style="width:450px;" class="blog-right">
            <h5><span><?php echo $rp[$j]['reply_name']; ?></span> </h5>
            <p><?php echo $rp[$j]['reply_desc']; ?></p>
         </div>
    </article>
   <?php }}?>
   
   
   
   <div class="borderunder"></div>

 <?php }?>
 
 
<div class="commentrespond">
       <?php
		if(isset($user_log['user_id'])){
			//print_r($user_log);
	  ?>
 <h3 class="comment-reply-title">Leave a Comment </h3>
<form action="" method="post">
    <p class="comment-form-author">
        <label for="author">Name <span class="required">*</span></label><br />
        <input id="author" name="fcomment_name" type="text" value="<?php echo $user_log['username'];  ?>" size="30" aria-required="true">
    </p>
     
    <p class="comment-form-email">
        <label for="email">Email <span class="required">*</span></label> <br />
        <input id="email" name="fcomment_email" type="text" value="<?php echo $user_log['email'];  ?>" size="30" aria-required="true">
    </p>
   <input type="hidden" name="forum_id" value="<?php echo $forumdata['forum_id']; ?>" /> 
    
    
    <p class="comment-form-comment">
        <label for="comment">Comment</label><br />
        <textarea id="comment" required='required' name="fcomment_desc" cols="45" rows="8" aria-required="true"></textarea>
    </p>						 
                                                    
    <p class="form-submit">
    <input name="submit" type="submit" id="submit" value="Post Comment">
     </p>
</form>

<?php } else{ ?>
 <h3 class="comment-reply-title"><a style="color:#00F; text-decoration:underline" href="<?php echo JEWISH_URL;?>/login?redirect=<?php echo current_url(); ?>">login</a> your account and reply on the topic </h3>


<?php }?>

</div> 
<!-- <h2><span>0</span>Responses</h2>
--> </section>

<?php }}?>




</div>
<aside class="side-bar-right">
 <h2>Jewish Community Announcements</h2>
 <ul>
     <li>1 day ago<a href="#">Join Our Community Celebration!</a></li>
     <li>08 Apr, 2015<a href="#">Check Out Etsy's Redesigned 
Seller Handbook!</a></li>
     <li>08 Apr, 2015<a href="#">Check Out Etsy's Redesigned 
Seller Handbook!</a></li>
     <li>08 Apr, 2015<a href="#">Check Out Etsy's Redesigned 
Seller Handbook!</a></li>
     <li>08 Apr, 2015<a href="#">Check Out Etsy's Redesigned 
Seller Handbook!</a></li>
  </ul>

<h4><a href="#">Forums Guidelines</a><a href="#">Teams</a></h4>
</aside>



 <div class="clear"></div>
 </article>
</div>


 