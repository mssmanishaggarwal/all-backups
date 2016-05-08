<script>console.log('view/forum/user_profile.php')</script>
<div class="container">
 <article class="page-content">
 <?php 
 $user_log=$this->session->userdata('logged_in');
  if(isset($user_log['user_id']) ){ ?>
		<p>Hi , <?php echo $user_log['email'];?></p>		
	<?php }			?>
 <p>Login Done</p>
 <p><a href="<?php echo JEWISH_URL;?>/myaccount/logout" >Log Out</a></p>
 </article>
</div> 