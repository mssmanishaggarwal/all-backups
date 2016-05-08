<script>console.log('view/forum/newthreads.php')</script>
 <script src="<?php echo JEWISH_URL;?>/js/ckeditor/ckeditor.js" type="text/javascript"></script> 





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

 <article class="page-content">

  <ul class="page-nav">

    <li><a href="#">homepage></a></li>

    <li><a href="<?php echo JEWISH_URL;?>/forum/">community Forums</a></li>

  </ul>

<ul class="page-navi">

 <li>Community <span>Forums</span></li>

 <?php 

 

 

 

 //print_r($catd);

 for($i=0;$i<sizeof($catd);$i++)

 {

	 if($catd[$i]->f_cat_slug == $this->uri->segment(2)){

	echo "<li><a class='selected'>".$catd[$i]->f_cat_name."</a></li>" ; 

	 }

	 else{

	echo "<li><a href='".JEWISH_URL."/forum/".$catd[$i]->f_cat_slug."'>".$catd[$i]->f_cat_name."</a></li>" ; 

	 }

 }

  

 ?>

 <?php 
 if($this->session->userdata('logged_in'))
 {
 ?>
<a href='<?php echo JEWISH_URL;?>/forum/yourthreads'><div class="yourpost">My Threads</div></a>
<?php }
 else
 {
 ?>
<a href='<?php echo JEWISH_URL;?>/login'><div class="yourpost">My Threads</div></a>
<?php }?>

 <?php 

 $userid=$this->session->userdata('logged_in');

 if($userid['user_id']){

 ?>    

 <li><a href='<?php echo JEWISH_URL;?>/forum/newthreads'>New Threads</a></li>      

 <?php } ?>

 

 </ul>   
<a href='<?php echo JEWISH_URL;?>/forum/yourthreads'><div class="yourpost">Your Threads</div></a>

<a href='<?php echo JEWISH_URL;?>/forum/newthreads'><div class="createpost">Create Post</div></a>

<div style="clear:both;border-bottom:1px #ccc solid"><br></div>

<?php if(isset($_REQUEST['indata'])){ ?><p style="padding:5px; color:#F00;border:1px solid #58E2C9;">Your post has been added successfully</p><?php }?>

<div class="content-left">

 

<?php  

	  $user_log=$this->session->userdata('logged_in');

 	 ?>

<section class="community-area">

   



 

 

<div class="commentrespond">

       <?php

		if(isset($user_log['user_id'])){

			//print_r($user_log); $user_log['user_id']

			 $date = date('20y-m-d h:i:s', time());

			

	  ?>

 <h3 class="comment-reply-title">New Thread </h3>

  <div class="borderunder"></div>

<form action="" method="post">

    <p class="comment-form-author">

        <label for="author">Topic Name <span class="required">*</span></label><br />

        <input id="author" name="forum_name" type="text" value="" size="30" aria-required="true">

    </p>

     <p class="comment-form-email"> 

        <label for="email">Type of Topic <span class="required">*</span></label> <br />

        <select name="forum_cat">

        <option value="1">Questions</option>

        <option value="2">Announcements</option>

        <option value="3">Discussions</option>

        <option value="4">Chitchat</option>

        </select>

     </p>

   <input type="hidden" name="forum_author" value="<?php echo $user_log['user_id'] ?>" /> 

   <input type="hidden" name="forum_modified_date" value="<?php echo $date ?>" /> 

     <p class="comment-form-comment">

        <label for="comment">Comment</label><br />

 

  <textarea required='required' id="editor1" name="forum_content" cols="45" rows="8" class="cinput3_ required ckeditor"></textarea>

    </p>						 

     <p class="form-submit">

    <input name="thread" type="submit" id="submit" value="Post Thread">

     </p>

</form>



</div> 


<?php

?>



<!-- <h2><span>0</span>Responses</h2>

--> 





<?php } else{
				 $date = date('20y-m-d h:i:s', time());

	
	?>


<div class="commentrespond">

 
 <h3 class="comment-reply-title">New Thread </h3>

  <div class="borderunder"></div>

<form action="" method="post">

    <p class="comment-form-author">

        <label for="author"> Name <span class="required">*</span></label><br />
   <input type="text" name="forum_author_name" value="" /> 
 
    </p>  
    
    
    
    <p class="comment-form-author">

  <label for="author">Email <span class="required">*</span></label><br />
   <input type="text" name="forum_author_email" value="" /> 
       <span style="padding-left:5px;font-size:14px; position: relative;top: -33px;">
        <span style="padding-right:5px; font-weight:bold;font-size:17px; ">OR </span> <a style="font-weight:bold; color:#57e2ca"
         href="<?php echo JEWISH_URL;?>/login/redirect/?redirect=<?php echo JEWISH_URL;?>/forum/newthreads">Login</a> to your account</span>
     </p>



    <p class="comment-form-author">

        <label for="author">Topic Name <span class="required">*</span></label><br />

        <input id="author" name="forum_name2" type="text" value="" size="30" aria-required="true">

    </p>

     <p class="comment-form-email"> 

        <label for="email">Type of Topic <span class="required">*</span></label> <br />

        <select name="forum_cat">

        <option value="1">Questions</option>

        <option value="2">Announcements</option>

        <option value="3">Discussions</option>

        <option value="4">Chitchat</option>

        </select>

     </p>

 
   <input type="hidden" name="forum_modified_date" value="<?php echo $date; ?>" /> 

     <p class="comment-form-comment">

        <label for="comment">Comment</label><br />

 

  <textarea required='required' id="editor1" name="forum_content" cols="45" rows="8" class="cinput3_ required ckeditor"></textarea>

    </p>						 

     <p class="form-submit">

    <input name="thread2" type="submit" id="submit" value="Post Thread">

     </p>

</form>



</div> 
<?php }?>

</section>
</div>

<?php include('sidebar.php'); ?>







 <div class="clear"></div>

 </article>

</div>





 