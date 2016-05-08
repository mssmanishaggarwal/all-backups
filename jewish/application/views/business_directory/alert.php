
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/business.css">
<div class="container">
 <article class="page-content">
 <?php if($alert_type=='notify_email'){?>
 	 <section class="loginBox">
     <h1 class="test-signup-title">Check your Email to Submit Your Business to Jewish Classified</h1>
         <p>To submit your business for addition to Jewish Classified, please click the confirmation link in the email that was sent to <strong><?php echo $email;?></strong>.</p>
         <p><a href="<?php echo JEWISH_URL;?>/business_directory/">Back to Welcome Page</a></p>
	</section>
 <?php } ?>
 </article>
</div>