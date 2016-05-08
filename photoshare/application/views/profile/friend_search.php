<?php 
$session_data=$this->session->userdata('logged_in');
$data=$this->logmodel->get_user_data($session_data['user_id']); //print_r($data);?>
      <div class="middle-bar"><?php $var=explode(' ',$_GET['q']); ?>
        <h1 class="small-head">Search Result</h1>
        <?php $frnds=$this->profile_model->frnd_srch($var,count($var)); 
        $count=1;
        foreach($frnds as $val){
          $k=$this->profile_model->me_friend($data[0]['id'],$val['id']);
       // print_r($frnds);
//print_r($frnds);echo $data[0]['id'];
          ?>
            <div class="search-block">
              <a href="<?php echo base_url()?>profile/friend/?frs=<?php echo $val['id'];?>" class="linktofriend">
              <div class="search-prof-pic">
              <img src="<?php profile_pic_setter($val['profile_pic']);?>" height="30" width="30" class="search-profiler"/>
              <h1 class="search-prof-name" id="after_<?php echo $count;?>"><?php echo $val['Full_Name'];?></h1>
              </div>
              </a>
              <?php  $frn=$this->profile_model->check_friend_request($data[0]['id'],$val['id']);
//print_r($frn);
             if($frn==''){?>

              <a href="#" data-userid="<?php echo $val['id']?>" data-count="<?php echo $count;?>" data-currentuserid="<?php echo $data[0]['id'];?>" class="addfrnd" id="adfrd_<?php echo $count;?>">
              <div class="search-prof-addfriend">Add Friend</div></a>
              <?php }else if($frn['friend_one']==$data[0]['id'] && $frn['status']=='0'){?>
              <div class="search-prof-sent">Request Sent</div>
              <?php  }else if((!empty($k[0]['friend_one'])==$data[0]['id']|| !empty($k[0]['friend_two'])==$data[0]['id']) && !empty($k[0]['status'])=='2'){?>
              <div class="search-prof-cldfrnd">You</div>
              <?php }else if(($frn['friend_one']==$data[0]['id']|| $frn['friend_two']==$data[0]['id']) && $frn['status']=='1'){?>
              <div class="search-prof-cldfrnd">Friend</div>
              <?php  }else{?>

              <a href="#" data-userid="<?php echo $val['id']?>" data-count="<?php echo $count;?>" data-currentuserid="<?php echo $data[0]['id'];?>" class="confirmfrnd" id="adfrd_<?php echo $count;?>">
              <div class="search-prof-confirmfrnd">Confirm Friend</div></a>
              <?php } ?>
              <div class="clr"></div>
            </div>
        <?php $count++;} ?> 
            
      </div>
    <?php 
      function profile_pic_setter($pic_url){
        if($pic_url==''){
          echo 'http://gymkhana.iitb.ac.in/~sports/images/profile.png'; 
        }else{
          echo $pic_url;
        }
      }

    ?>
