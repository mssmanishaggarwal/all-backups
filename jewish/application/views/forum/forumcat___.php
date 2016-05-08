<script>console.log('view/forum/forumcat.php')</script>
 <script src="<?php echo JEWISH_URL;?>/js/ckeditor/ckeditor.js" type="text/javascript"></script> 



<script>

 $(document).ready(function(){

	// alert('dsfsdaff');

   $(".comreply").click(function(){

   $(".comrdesc").hide();	   

   var comre=$(this).attr('id');

   $('.'+comre).toggle('slow');

  	  });	



  $(".editme").click(function(){  

 	$(".community-area").show();  



	});	

function IsEmail(email) {

  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  return regex.test(email);

}	

	$(".checking").click(function(){

		$(".loader").show();

	 var fcomment_name = $("#fcomment_name").val();	

		if(fcomment_name){

			var fcomment_email = $("#fcomment_email").val();

 			if(IsEmail(fcomment_email)){

 			  $.ajax({

				  type: 'post',

				  url: "<?php echo site_url('forum/commentlogin'); ?>",

				  data:'fcomment_name='+fcomment_name+'&fcomment_email='+fcomment_email,

				  success: function (data) {

				  //alert(data);

				  //alert('form was submitted');

				   var extra=$(".extra").html();

				   $(".nextsection").html(extra);

				   $(".firstsection").hide();	

				  $(".loader").hide();

 				  $(".comment-reply-title").hide();

				   }

				  });	 

			}

			else{

			   alert('Please insert  a valid email id');	 

 			}

		}

	 else{

		alert("please insert your username"); 

	 }

 	});

	

	

	

	

	$("#insertcomment").on('submit', function (e) {

		//alert($(".myform").attr('title'));

 		e.preventDefault();

		var kdd = $("#insertcomment").serialize();

	//	alert(kdd);

			$.ajax({

				type: 'post',

				url: "<?php echo site_url('forum/insert_forum'); ?>",

				data: $('#insertcomment').serialize(),

				success: function (data) {

				//	alert(data);

				//alert('form was submitted');
				location.reload();

 				//$("#preview_form").resetForm();

				}

			});

 	});	  

	

	

	

	

	

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

$this->uri->segment(2);

 

 

 

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

 

 

 </ul>
<a href='<?php echo JEWISH_URL;?>/forum/yourthreads'><div class="yourpost">Your Threads</div></a>
<a href='<?php echo JEWISH_URL;?>/forum/newthreads'><div class="createpost">Create Post</div></a>

<div style="clear:both;border-bottom:1px #ccc solid"><br></div>



<div class="content-left">

<?php

  if(!$this->uri->segment(3)){

	  

?>

 <section class="forums-post">

 <?php

  // echo $this->uri->segment(3);

 

    foreach($forumdata as $ky=>$val)

  {

   if($this->uri->segment(2)==strtolower($ky)){

  ?> 

 

 <h3><a href="<?php echo JEWISH_URL;?>/forum/<?php echo strtolower($ky); ?>/"><?php echo $ky;  ?></a></h3>

  <ul>

  <?php

   

   for($i=0;$i<sizeof($forumdata[$ky]);$i++)

  {

 	    ?>

  

  

       <li>

<!--       <figure class="thum2"><img width="50" height="50" src="<?php //echo JEWISH_URL;?>/<?php // echo $forumdata[$ky][$i]['forum_author_image'] ; ?>" alt=""></figure>

-->       <h4><a href="<?php echo JEWISH_URL;?>/forum/<?php echo strtolower($ky); ?>/<?php echo $forumdata[$ky][$i]['forum_slug'] ; ?>"><?php echo $forumdata[$ky][$i]['forum_name'] ; ?></a><br><span><?php echo strtolower($ky); ?></span></h4>

       <h5><span><?php  echo $forumdata[$ky][$i]['forumcomment_count'] ;?></span><?php  echo $forumdata[$ky][$i]['forum_modified_date'] ;?></h5>

       </li>

       <?php }} ?>

    </ul>

 

       <?php } ?>

</section>

<?php } 

 if($this->uri->segment(3)){

	  $user_log=$this->session->userdata('logged_in');

 	 ?>

<section class="community-area">

 <p class="qus"><?php echo $forumdata['forum_name'];?></p>

  <h3 style="float:left; margin-left:0; margin-bottom:10px;"><?php echo $forumdata['forum_name'];?></h3><br />

 <?php

   if($user_log['user_id']==$forumdata['forum_author_id']){

 ?>



  <div class="editme">Edit</div>

  <?php }?>

  

  <div style="clear:both"></div>

  

 <?php

  if($user_log['user_id']==$forumdata['forum_author_id']){

 

//echo $this->router->fetch_method();

 ?>

<section style="display:none;" class="community-area">

  

<div class="commentrespond">

       <?php

			//print_r($user_log); $user_log['user_id']

			 $date = date('20y-m-d h:i:s', time());

			

	  ?>

   <div class="borderunder"></div>

   

<form action="" method="post">

    <p class="comment-form-author">

        <label for="author">Topic Name <span class="required">*</span></label><br />

        <input id="author" name="forum_name" type="text" value="<?php echo $forumdata['forum_name'];?>" size="30" aria-required="true">

    </p>

     <p class="comment-form-email"> 

        <label for="email">Type of Topic <span class="required">*</span></label> <br />

        <select name="forum_cat"> 	

         <option <?php if($forumdata['forum_cat']==1)echo "selected='selected'";?> value="1">Questions</option>

        <option <?php if($forumdata['forum_cat']==2)echo "selected='selected'";?> value="2">Announcements</option>

        <option <?php if($forumdata['forum_cat']==3)echo "selected='selected'";?> value="3">Discussions</option>

        <option <?php if($forumdata['forum_cat']==4)echo "selected='selected'";?> value="4">Chitchat</option>

        </select>

     </p>

   <input type="hidden" name="forum_id" value="<?php echo $forumdata['forum_id'] ?>" /> 

   <input type="hidden" name="forum_modified_date" value="<?php echo $date ?>" /> 

     <p class="comment-form-comment">

        <label for="comment">Comment</label><br />

        <textarea id="comment" required='required' name="forum_content" class="ckeditor" cols="45" rows="8" aria-required="true"><?php echo $forumdata['forum_content'];?></textarea>

    </p>						 

     <p class="form-submit">

    <input name="threadupdate" type="submit" id="submit" value="Update">

     </p>

</form>



</div> 

<!-- <h2><span>0</span>Responses</h2>

--> </section>  

  

   

  <?php }?>

  

  

 <article class="blog">

<!--  <figure class="thum1"><img width="80" src="<?php //echo JEWISH_URL;?>/<?php // echo $forumdata['forum_author_image'] ; ?>" alt=""></figure>

-->  <div class="blog-right">

   <h5><span><?php  echo $forumdata['forum_author'];  ?></span> &nbsp; <?php echo $forumdata['forum_modified_date'] ; ?>  </h5>

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

<!--        <figure class="thum1">

        <img width="40" src="<?php //if($forumcomment[$i]['forum_author_image']){echo $forumcomment[$i]['forum_author_image'];}else{ echo JEWISH_URL;?>/upload/nouser.png<?php //}?>" alt=""></figure>

-->        <div class="blog-right">

            <h5><span><?php echo $forumcomment[$i]['fcomment_name']; ?></span> </h5>

            <p><?php echo $forumcomment[$i]['fcomment_desc']; ?></p>

            <p id="comrply<?php echo $i; ?>" class="comreply">Reply <img src="<?php echo JEWISH_URL;?>/images/arrow-d.png" /></p>

        </div>

    </article>

       <?php

		if($this->session->userdata('comuser_name')){

			$sesval = $this->session->userdata('comuser_name');

			//print_r($user_log);

	  ?>



        <div style="display:none" class="commentrespond comrdesc comrply<?php echo $i; ?>">

            <form action="" id="replysubmit<?php echo $i;?>"  method="post">

                <p class="comment-form-author">

                <!--                <label for="author">Name <span class="required">*</span></label><br />

                --><input id="author" name="reply_name" class="reply_name" type="hidden" value="<?php echo $sesval['comuser_name'];  ?>" size="30" aria-required="true">

                </p>

                

                <p class="comment-form-email">

                <!--<label for="email">Email <span class="required">*</span></label> <br />

                --><input id="email" name="reply_email"  class="reply_email" type="hidden" value="<?php echo $sesval['email'];  ?>" size="30" aria-required="true">

                </p>

                <input type="hidden" name="fcomment_id" class="fcomment_id"  value="<?php echo $forumcomment[$i]['fcomment_id']; ?>" /> 

                <p class="comment-form-comment">

                <label for="comment">Comment</label><br />

                <textarea id="comment" required='required' name="reply_desc" class="reply_desc" class="cinput3_ required ckeditor" cols="45" rows="8" aria-required="true"></textarea>

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

<!--        <figure class="thum1">

        <img width="40" src="<?php //if($rp[$i]['forum_author_image'])

		//{echo $rp[$i]['forum_author_image'];}else{ 

		echo JEWISH_URL;?>/upload/nouser.png<?php //}?>" alt=""></figure>

-->        <div style="width:450px;" class="blog-right">

            <h5><span><?php echo $rp[$j]['reply_name']; ?></span> </h5>

            <p><?php echo $rp[$j]['reply_desc']; ?></p>

         </div>

    </article>

   <?php }}?>

   

   

   

   <div class="borderunder"></div>



 <?php }?>

 

 

<div class="commentrespond">

       <?php

 //$this->session->sess_destroy()

	//	if(isset($user_log['user_id'])||$useremail=''){
$user_log = $this->session->userdata('logged_in');
			//print_r($user_log);

  $sesval = $this->session->userdata('username'); 

  if(!$user_log['email']){ 			

	  ?>

 <h3 class="comment-reply-title">To Reply on this topic choose an option below</h3> <?php }?>

      <img class="loader" style="  position: absolute;left: 5px;top: 29px; display:none; " src="<?php echo JEWISH_URL;?>/images/ajax-loader.gif" />



<form action="" method="post" id="insertcomment">

<?php

  if(sizeof($this->session->userdata('username'))){

  $sesval = $this->session->userdata('username');}

?>

<div class="firstsection">

   <?php if(!$user_log['email']){ ?>

    <p class="comment-form-author">

        <label for="author">Username <span class="required">*</span></label><br /> </p><?php }?>

        <input id="fcomment_name" required="required" name="fcomment_name" <?php if($user_log['email']){ echo 'type="hidden"';}else{?> type="text"<?php }?> value="<?php echo $user_log['username'];  ?>" size="30" aria-required="true">

   

  <?php if(!$user_log['email']){ ?>     

    <p class="comment-form-email">

        <label for="email">Email <span class="required">*</span></label> <br /> </p><?php }?>

        <input id="fcomment_email" name="fcomment_email"  <?php if($user_log['email']){ echo 'type="hidden"';}else{?> type="text"<?php }?> value="<?php echo $user_log['email'];  ?>" size="30" aria-required="true">

         <?php if(!$user_log['email']){ ?> <span style="padding-left:5px;font-size:14px; position: relative;top: -33px;">

        <span style="padding-right:5px; font-weight:bold;font-size:17px; ">OR </span> <a style="font-weight:bold;" href="<?php echo site_url('login'); ?>">Login</a> to your account and reply on the topic</span><?php }?>

     

   <input type="hidden" name="forum_id" value="<?php echo $forumdata['forum_id']; ?>" /> 

   <?php if(!$user_log['email']){?> <div class="checking">Go</div><?php } ?>

   </div>

    <div class="nextsection" >



    

    <?php 

 	  if($user_log['email']){

	

		?>

    <p class="comment-form-comment">

        <label for="comment">Comment</label><br />

        <textarea id="comment" required='required' name="fcomment_desc" cols="45" rows="8" aria-required="true"></textarea>

    </p>						 

                                                    

    <p class="form-submit">

    <input name="submit" type="submit" id="submit" value="Post Comment">

     </p> <?php } ?>

     </div>

</form>



<div style="display:none" class="extra">

    <p class="comment-form-comment">

        <label for="comment">Comment</label><br />

        <textarea id="comment" required='required' name="fcomment_desc" cols="45" rows="8" aria-required="true"></textarea>

    </p>						 

                                                    

    <p class="form-submit">

    <input name="submit" type="submit" id="submit" value="Post Comment">

     </p>



</div>







<?php //}

 //else{ ?>

<!-- <h3 class="comment-reply-title"><a style="color:#00F; text-decoration:underline" href="<?php echo JEWISH_URL;?>/login?redirect=<?php echo current_url(); ?>">login</a> your account and reply on the topic </h3>

-->



<?php //}?>



</div> 

<!-- <h2><span>0</span>Responses</h2>

--> </section>



<?php }



}?>









</div>

<?php include('sidebar.php'); ?>







 <div class="clear"></div>

 </article>

</div>





 