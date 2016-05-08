
 <link rel="stylesheet" href="<?php echo base_url()?>/css/social.css">


  <?php 
$session_data=$this->session->userdata('logged_in');
$data=$this->logmodel->get_user_data($session_data['user_id']); //echo '<pre>';print_r($data);echo '</pre>';?>
<article class="registration-page-wrap clearfix">
  <section class="registration-page-inner clearfix">
    <a href="<?php echo base_url()?>profile/news/"><div class="reg-top-l">Hi, <?php echo $data[0]['f_name'];  ?></div></a>
    <p><br></p><p><br></p>
      <div class="left-bar">
        <div class="friend-list-block">
            <div class="profile-picture">

              <img src="<?php echo profile_pic_setter1($data[0]['profile_pic']);?>" height="150" width="150"/>
            </div>
            <div class="profile-info">
              <p>DOB:<?php $yrdata= strtotime($this->profile_model->profile_info('birth_day',$data[0]['id']));if($yrdata!=''){echo date('jS F Y', $yrdata);}?></p>
              <p>Contact Number:<?php echo $this->profile_model->profile_info('contact_no',$data[0]['id']);?></p>
              <p>Register From: <?php  $yrdata= strtotime($this->profile_model->profile_info('user_register',$data[0]['id']));if($yrdata!=''){echo date('jS F Y', $yrdata);}?></p>
            </div>
            <div style="clear:both;"></div>
           <h1 class="small-head">Friend List</h1>
           <?php $accept_frnd=$this->profile_model->accepted_frnd_request($data[0]['id']);
              $count=1;
              //print_r($accept_frnd);
             foreach($accept_frnd as $val){
              $fr_id=$this->logmodel->get_userid_by_mail($val['email']);
              //echo ($fr_id);
          ?>
              <a href="<?php echo base_url()?>profile/friend/?frs=<?php echo $fr_id;?>"><div class="single-friend-block">
                <img src="<?php profile_pic_setter1($val['profile_pic']);?>" height="70" width="65"/>
                <h1 class="frn-name"><?php echo $val['f_name'].' '.$val['l_name'];?></h1>
              </div></a>
            <?php } ?>
            <div class="clr"></div>
            
        </div>
        <h1 class="small-head">Pending Request</h1>
        <?php $pending_frnd=$this->profile_model->pending_frnd_request($data[0]['id']);
        $count=1;
              foreach($pending_frnd as $val){
        ?>
        <div class="search-block-pending-request">
              <a href="<?php echo base_url()?>profile/friend/?frs=<?php echo $val['id'];?>" class="linktofriend">
              <div class="search-prof-pic"><img src="<?php profile_pic_setter1($val['profile_pic']);?>" height="30" width="30" class="search-profiler"/>
              <h1 class="search-prof-name" id="afterd_<?php echo $count;?>"><?php echo $val['f_name'];?></h1>
              </div>
              </a>
              <a href="#" data-userid="<?php echo $val['id']?>" data-count="<?php echo $count;?>" data-currentuserid="<?php echo $data[0]['id'];?>" class="addfrnd-left" id="adfrdf_<?php echo $count;?>">
              <div class="accept-friend">Accept It</div></a>
              <div class="clr"></div>
            </div>
        <?php $count++;}?>
         <div class="clr"></div>
         <h1 class="small-head">Sent Request</h1>
        <?php $pending_frnd=$this->profile_model->sent_frnd_request($data[0]['id']);
        $count=1;
              foreach($pending_frnd as $val){
        ?>
        <div class="search-block-sent-request">
              <a href="<?php echo base_url()?>profile/friend/?frs=<?php echo $val['id'];?>" class="linktofriend">
              <div class="search-prof-pic"><img src="<?php profile_pic_setter1($val['profile_pic']);?>" height="30" width="30" class="search-profiler"/>
              <h1 class="search-prof-name" id="afterd_<?php echo $count;?>"><?php echo $val['f_name'];?></h1>
              </div>
              </a> 
              <div class="sent-friend">Request Sent</div> 
              <div class="clr"></div>
              </div>
            
        <?php $count++;}?>

         <div class="clr"></div>
        </div>
      </div>

 <?php 
      function profile_pic_setter1($pic_url){
        if($pic_url==''){
          echo 'http://gymkhana.iitb.ac.in/~sports/images/profile.png'; 
        }else{
          echo $pic_url;
        }
      }

    ?>

