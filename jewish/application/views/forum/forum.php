<script>console.log('view/forum/forum.php')</script>
 <div class="container">

 <article class="page-content">

  <ul class="page-nav">

    <li><a href="#">homepage></a></li>

    <li><a href="<?php echo JEWISH_URL;?>/forum/">community Forums</a></li>

  </ul>

<ul class="page-navi">

 <li>Community <span>Forums</span></li>

 <?php 

 //print_r($catd);

 for($i=0;$i<sizeof($catd);$i++)

 {

	echo "<li><a href='".JEWISH_URL."/forum/".$catd[$i]->f_cat_slug."'>".$catd[$i]->f_cat_name."</a></li>" ; 

 }

  ?>

 <?php 
 if($this->session->userdata('logged_in'))
 {
 ?>
<a href='<?php echo JEWISH_URL;?>/forum/yourthreads'><div class="yourpost">My Threads</div></a>
<?php }
 else
 {
 ?>
<a href='<?php echo JEWISH_URL;?>/login'><div class="yourpost">My Threads</div></a>
<?php }?>

 <?php 

 $userid=$this->session->userdata('logged_in');

 if($userid['user_id']){

 ?>    

 <li><a href='<?php echo JEWISH_URL;?>/forum/newthreads'>New Threads</a></li>      

 <?php } ?>

 </ul>
 <?php 
 if($this->session->userdata('logged_in'))
 {
 ?>
<a href='<?php echo JEWISH_URL;?>/forum/yourthreads'><div class="yourpost">My Threads</div></a>
<?php }
 else
 {
 ?>
<a href='<?php echo JEWISH_URL;?>/login'><div class="yourpost">My Threads</div></a>
<?php }?>

<a href='<?php echo JEWISH_URL;?>/forum/newthreads'><div class="createpost">Create Post</div></a>

<div style="clear:both;border-bottom:1px #ccc solid"><br></div>



<div class="content-left">

 

 
 <section class="forums-post">
 <h3>All Threads</h3>

 
 

 
  <ul>

  <?php

   for($i=0;$i<sizeof($forumdata);$i++)

  {

 	    ?>

  

  

       <li>

<!--       <figure class="thum2"><img width="50" height="50" src="<?php echo JEWISH_URL;?>/<?php //echo $forumdata[$ky][$i]['forum_author_image'] ; ?>" alt=""></figure>

-->       <h4><a href="<?php echo JEWISH_URL;?>/forum/<?php echo strtolower($forumdata[$i]['catname']); ?>/<?php echo $forumdata[$i]['forum_slug'] ; ?>"><?php echo $forumdata[$i]['forum_name'] ; ?></a><br><span style="display:none"><?php echo strtolower($ky); ?></span></h4>

       <h5><span><?php  echo $forumdata[$i]['forumcomment_count'] ;?></span><?php  echo $forumdata[$i]['forum_modified_date'] ;?></h5>

       </li>

       <?php } ?>

       

    </ul>

 

 
</section>








</div>

<?php include('sidebar.php'); ?>









 <div class="clear"></div>

 </article>

</div>





 