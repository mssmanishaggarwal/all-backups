<script>console.log('view/alert.php')</script>
<div class="container">
 <article class="page-content">
 <?php if($alert_type=='have_account'){?>
 	 <section class="loginBox">
<p>This Email ID already exists .</p>

<p>Please login with different Email ID.</p>

<p><a href="<?php echo JEWISH_URL;?>/login/">Back to Login Page</a></p>
	</section>
 <?php }else if($alert_type=='insert_account'){ ?>
	 <section class="loginBox">
<p>Thanks for signing up for a Jewish Classified account.</p>

<p>A link to activate your account has just been emailed to <em style="font-weight:bold;"><?php echo $user_email;?></em></p>

<p>If you experience any problems or have any questions, please contact support.</p>
	</section>
 <?php }else if($alert_type=='invalid_url'){?>
 	<section class="loginBox">
<p style="color:red;">This link is not valid.</p>


	</section>
 <?php }else if($alert_type=='pwdset'){ ?>
 	<section class="loginBox">
<p >You have Setup Your password successfully.</p>
<p><a href="<?php echo JEWISH_URL;?>/login/"><input type="submit" value="Back to Login Page" name="submtadd"></a></p>

	</section>
 <?php }else if($alert_type=='post_published'){ ?>
 	<section class="loginBox">
           <p>Your post has been published successfully.</p>
           <p>An email containing a link to edit your post has been sent to <?php echo $email_id;?>.</p>
           <p><a href="<?php echo JEWISH_URL;?>/"><input type="submit" value="Back To Home page" name="submtadd"></a></p>

	</section>
 <?php } else if($alert_type=='unauth'){ ?>
 	<section class="loginBox">
           <p>Unauthentic Access.</p>
           

	</section>
 <?php } ?>
 </article>
</div>
<style>
.loginBox > p > a >[type="submit"] {
 border: none;
  font-family: 'segoe_uibold';
  background-color: #57e2ca;
  color: white !important;
  padding: 0px 3px;
    width: 163px !important;
	cursor:pointer;
}
</style>