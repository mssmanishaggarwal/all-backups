<script>console.log('view/login.php')</script>
<div class="container">
 <article class="page-content">
 <script>
 jQuery(document).ready(function($) {
    $(".explanation").on('click',function(){
		$("#reset_pwd").slideToggle(500);
	});
	$("#sbmt").click(function(){
		$(this).hide();
		});
});
 </script>
 
<?php $attributes = array('id' => 'login');
                   echo form_open('myaccount/', $attributes);
				   ?>
            <br>

            <section class="loginBox">
                <h4 class="ban">Log in to your Jewish Classified account</h4>
                 <?php  if(isset($alert)&& !empty($alert) ){ 
				 				if($alert=='not_active_yet'){?>
								<div class="alert">Your Account not been activeted yet, please check mail</div>	
								<?php }else if($alert=='not_exists'){?>
                                <div class="alert">Please register first then try to login</div>
				                <?php }else if($alert=='pwd_not_exists'){?>
                                <div class="alert">Password Doesnot match</div>
				               <?php } else if($alert=='mail_not_exists' || $alert=='pwd_reset'){?>
                              <style>
							  #reset_pwd{
	                                           display:block;
                                  }
                              </style>
                                
				<?php }  }			
				  ?>
                <p>
                    <label for="inputEmailHandle">Email:</label>
                    <input type="email" id="inputEmailHandle" name="inputEmailHandle" value="" autocomplete="off" required="required">
                </p>
                <p>
                    <label for="inputPassword">Password:</label>
                    <input id="inputPassword" type="password" name="inputPassword" autocomplete="off" required="required">
                </p>
                
                <p>
                    <label>&nbsp;</label>
                    <button type="submit">Log In</button>
                    <span class="explanation" >Forgot password?</span>
                </p>
          
            </section>
        <?php echo form_close(); ?>
		<?php $atr = array('id' => 'reset_pwd');
                   echo form_open('login/reset_password', $atr);
				   ?>
                   <section class="loginBox">
                <h4 class="ban">Place your mail ID and reset password</h4>
                <?php  if(isset($alert)&& !empty($alert) ){ 
				if($alert=='pwd_reset'){?>
                                <div class="alert_gr">A new password has sent to your mail</div>
				 <?php } else if($alert=='mail_not_exists'){?>
                              <style>
							  #reset_pwd{
	                                           display:block;
                                  }
                              </style>
                                <div class="alert">This Email ID is not registered or Activated yet</div>
				<?php } 
				}?>
                 <p>
                    <label for="inputPassword">Enter Email ID:</label>
                    <input id="inputemaily" type="email" name="inputemaily" autocomplete="off" required="required">
                </p>
                 <p>
                    <label>&nbsp;</label>
                    <button type="submit" id="sbmt">Reset Password</button>
                </p>
                </section>
                <?php echo form_close(); ?>
        <p class="boxConjunction">
            or
        </p>
       <?php $attributes = array('class' => 'email', 'id' => 'myform');
                   echo form_open('login/create_account', $attributes);
					function generateRandomString($length = 10) {
						$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$charactersLength = strlen($characters);
						$randomString = '';
						for ($i = 0; $i < $length; $i++) {
							$randomString .= $characters[rand(0, $charactersLength - 1)];
						}
						return $randomString;
					}
	   ?>
          
            <input type="hidden" name="key" value="<?php echo generateRandomString();?>">

            <section class="loginBox">
                <h4 class="ban">Create a Jewish Classified account</h4>

                <p>
                    <label for="inputEmail">Email:</label>
                    <input type="email" id="emailAddress" name="emailAddress" value="" maxlength="64" required>
                </p>
                <p>
                    <label>&nbsp;</label>
                    <button type="submit">Create Account</button>
                </p>
            </section>
        <?php echo form_close(); ?>
 </article>
</div>