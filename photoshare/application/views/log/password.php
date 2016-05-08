<?php 

$session_data=$this->session->userdata('logged_in');
$data=$this->logmodel->get_user_data($session_data['user_id']); 
//echo '<pre>';print_r($data); echo '</pre>';

?>
<script>
$(document).ready(function(){
  $(document).on('submit','#pdsrt',function(em){
    var input_one=$('.otrpwd').val();
    var input_two=$('.otrpwd2').val();
    if(input_one!=input_two){
      em.preventDefault();
      $('#msr').html('Both password does not match');
      //alert();
    }else{
      return true;
    }
  })
});
</script>

<article class="registration-page-wrap clearfix">
  <section class="registration-page-inner clearfix">
    <section class="registration-form-holder clearfix">
    <?php if(!empty($data[0]['user_pass'])) {?>
      <form class="registration-form" method="post" action="<?php echo base_url(); ?>log/account/update_password/">
        <div class="reg-form-top clearfix">
          <div class="reg-top-l">Update Password</div>
            
          
          <div class="reg-form-row clearfix">
            <input type="password" placeholder="Old Password" class="input1 old_pwd" name="pwd" required>
            <span>Minimum 6 letters, maximum 25 letters</span>
          </div>
          
          <div class="reg-form-row clearfix">
            <input type="password" placeholder="New Password" class="input1 new_pwd" name="user_pass" required>
          </div> 
          
          
          </div> 
          <input type="hidden" name="user_id" value="<?php echo $data[0]['id']?>">
         
          
          <div class="reg-form-row m-form-accept clearfix">
          
          </div>
          
          <div class="reg-form-row clearfix">
            <div class="reg-form-sbmt"><input type="submit" value="Update my Password"></div>
          </div>
      </form>
    <?php }else { ?>
      <form class="registration-form" id="pdsrt" method="post" action="<?php echo base_url(); ?>log/account/set_password/">
        <div class="reg-form-top clearfix">
          <div class="reg-top-l">Set Password</div>
            
          <div id="msr"></div>
          <div class="reg-form-row clearfix">
            <input type="password" placeholder="Create Password" class="input1 otrpwd" name="pwd" required>
            <span>Set your password as you have registered with social media</span>
          </div>
          
          <div class="reg-form-row clearfix">
            <input type="password" placeholder="Confirm Password" class="input1 otrpwd2" name="user_pass" required>
          </div> 
          
          
          </div> 
          <input type="hidden" name="user_id" value="<?php echo $data[0]['id']?>">
         
          
          <div class="reg-form-row m-form-accept clearfix">
          
          </div>
          
          <div class="reg-form-row clearfix">
            <div class="reg-form-sbmt"><input type="submit" value="Set my Password"></div>
          </div>
      </form>
    <?php  } ?>
       
    </section>
  </section>
</article>

<div class="clear"></div>
<style>
#msr{
  font-size:20px;
  color:red;
}
</style>

