<script>console.log('view/account_activation.php')</script>
<script>
jQuery(document).ready(function($) {
   $("#rpsd").submit(function(e){
	   var first_pwd=$("#pwd").val();
	   var second_pwd=$("#rpwd").val();
	   if(first_pwd!=second_pwd){
		   e.preventDefault();
		   $("#alm").html("Both password does not matched");
	   }
	   }); 
});
</script>
<div class="container">
 <article class="page-content">
 <p>Your A/C hsbeen activated, please set a password for it</p>
      <?php $attributes = array('class' => 'rpm', 'id' => 'rpsd');
                   echo form_open('login/create_password', $attributes); ?>
                   <input type="hidden" name="u_id" value="<?php echo $user_id;?>"/>
   <section class="loginBox">
                <h4 class="ban">Create a Jewish Classified account</h4>

                <p>
                    <label for="inputEmail">Enter Password:</label>
                    <input type="password" id="pwd" name="pwd" value="" maxlength="64" required>
                </p>
                <p>
                    <label for="inputEmail">Retype Password:</label>
                    <input type="password" id="rpwd" name="rpwd" value="" maxlength="64" required>
                </p>
                <p id="alm" style="color:red;font-weight:bold;margin-left:250px;"></p>
                <p>
                    <label>&nbsp;</label>
                    <button type="submit">Set Password</button>
                </p>
            </section>
        <?php echo form_close(); ?>
 </article>
</div>