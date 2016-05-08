

<article class="registration-page-wrap clearfix">
  <section class="registration-page-inner clearfix">
    <section class="registration-form-holder clearfix">
      <form class="registration-form" method="post" action="<?php echo base_url(); ?>log/registration/fgd_pwd_val/">
        <div class="reg-form-top clearfix">
          <div class="reg-top-l">Forgate Password</div>
            <div class="reg-top-r">
             <!-- <div class="s-l">
                 <select>
                  <option value="">Option One</option>
                  <option value="">Option Two</option>
                  <option value="">Option Three</option>
                  <option value="">Option Four</option>
                </select> 
              </div></div>
             </div> 
        
        
        
        
        <div class="reg-form-row clearfix">
          <div class="reg-form-l"><input type="text" placeholder="First Name" class="input1"></div>
          <div class="reg-form-r"><input type="text" placeholder="Last Name" class="input1"></div>
        </div>-->
        
         <div class="reg-form-row clearfix">
            <input type="email" placeholder="Email address" class="input1" name="email" required>
            <span>Registered Email Address</span>
          </div>
          
         
         <!--  </div>
          <div class="reg-form-row clearfix">
            <input type="password" placeholder="Confirm Password" class="input1">
          </div>
          
          <div class="reg-form-row clearfix">
            <div class="reg-form-half"><input type="tel" placeholder="Mobile Number(xxx)xxx-xxxx"></div>
          </div> -->
          
          <!-- <div class="reg-form-row clearfix">
            <div class="reg-form-half reg-form-b-day">
              <span>Birthday</span>
              <div class="s-l">
              <select>
                <option value="">Date</option>
                <option value="">1</option>
                <option value="">2</option>
                <option value="">3</option>
              </select> 
          </div>
          	  <div class="s-l">
              <select>
                <option value="">Month</option>
                <option value="">Jan</option>
                <option value="">Feb</option>
                <option value="">Mar</option>
             </select> 
          </div>
              <div class="s-l">
            <select>
                <option value="">Year</option>
                <option value="">1980</option>
                <option value="">1981</option>
                <option value="">1982</option>
          </select> 
          </div>
            </div>
          </div> -->
          
          <!--  <div class="reg-form-row clearfix">
            <div class="reg-form-gender">
              <table width="200">
                <tr>
                  <td><input type="radio" name="sex" value="male" id="sex_0"></td>
                    <td class="gen-label">Male</td>
                  <td><input type="radio" name="sex" value="female" id="sex_1"></td>
                    <td class="gen-label">Female</td>
                </tr>
              </table>
           </div>
          </div> 
          
          <div class="reg-form-row clearfix">
            <div class="reg-form-half"><input type="email" placeholder="Your current Email Address"></div>
          </div>
          
         <div class="reg-form-row m-form-accept clearfix">
            <input type="checkbox" name="" value="">I agree to Photo Sharing Terms            <div class="m-check-field"><input name="" type="checkbox" value="I agree to Photo Sharing Terms"></div>
            <div class="m-check-text">I agree to Photo Sharing Terms</div>
          </div>-->

          
          <div class="reg-form-row clearfix">
            <div class="reg-form-sbmt"><input type="submit" value="Sign In"></div>
          </div>
        
      </form>
      <?php error_reporting(0);//echo '<pre>';print_r($_SESSION['User']);echo '</pre>';
        if($_SESSION['social']=='g'){
           $data=array('f_name'=>$_SESSION['User']['given_name'],
                        'l_name'=>$_SESSION['User']['family_name'],
                        'email'=>$_SESSION['User']['email'],
                        'gender'=>$_SESSION['User']['gender'],
                        'social'=>$_SESSION['social'],
                        'profile_pic'=>$_SESSION['User']['picture']
                        );
           $ids=$this->logmodel->checking_email($_SESSION['User']['email']);
           if($ids==0){
             $user_id=$this->logmodel->insert_user($data); 
           }else{
             $user_id=$this->logmodel->get_userid_by_mail($_SESSION['User']['email']);
            // print_r($user_id);exit;
           }
           
            $this->session->set_userdata( 'logged_in',array(
                            'fname'=>$_SESSION['User']['given_name'],
                            'email'      => $_SESSION['User']['email'],
                            'user_id'=>$user_id,
                    ));
            session_unset($_SESSION['User']);
            session_unset($_SESSION['social']);
            session_unset($_SESSION['token']);

            redirect('ps/pages/add_images/');
        }
      ?>
      <?php if ($_SESSION['social']=='fb'){
            $data=array('f_name'=>$_SESSION['first_name'],
                        'l_name'=>$_SESSION['last_name'],
                        'email'=>$_SESSION['email'],
                        'gender'=>$_SESSION['gender'],
                        'social'=>$_SESSION['social'],
                        'profile_pic'=>'https://graph.facebook.com/'.$_SESSION['FBID'].'/picture'
                        );
           $ids=$this->logmodel->checking_email($_SESSION['email']);
           if($ids==0){
             $user_id=$this->logmodel->insert_user($data); 
           }else{
             $user_id=$this->logmodel->get_userid_by_mail($_SESSION['email']);
           }
           
             $this->session->set_userdata( 'logged_in',array(
                            'fname'=>$_SESSION['first_name'],
                            'email'      => $_SESSION['email'],
                            'user_id'=>$user_id,
                    ));
        session_unset($_SESSION['social']);
        session_unset($_SESSION['FBID']);          
        session_unset($_SESSION['first_name']) ;
        session_unset($_SESSION['last_name']) ;
        session_unset($_SESSION['birth_day']);
        session_unset($_SESSION['gender']);
        session_unset($_SESSION['email']);
          redirect('ps/pages/add_images/');

       ?> 
    
        <?php }else {?>
      <a href="<?php echo base_url();?>log/registration/fb_auth/" ><img src="http://competitivezone.in/public/images/fblogin_mobile.png" width="250" height="50" /></a>
        <?php } ?>
      <a href="javascript:void(0);" class="login"><img src="http://commondatastorage.googleapis.com/io-2013/presentations/808/images/sign-in-button.png" width="250" height="50"/></a>
    </section>
  </section>
</article>

<div class="clear"></div>

