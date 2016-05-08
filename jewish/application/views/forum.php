<script>console.log('view/forum.php')</script>
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
 <li><a href='<?php echo JEWISH_URL;?>/forum/yourthreads'>Your Threads</a></li>  
 <?php 
 $userid=$this->session->userdata('logged_in');
 if($userid['user_id']){
 ?>    
 <li><a href='<?php echo JEWISH_URL;?>/forum/newthreads'>New Forum </a></li>      
 <?php } ?>
 </ul>

<div class="content-left">
 <section class="forums-post">
 <?php
    foreach($forumdata as $ky=>$val)
  {
  ?> 
 
 <h3><a href="<?php echo JEWISH_URL;?>/forum/<?php echo strtolower($ky); ?>/"><?php echo $ky;  ?></a></h3>
  <ul>
  <?php
   for($i=0;$i<sizeof($forumdata[$ky]);$i++)
  {
 	    ?>
  
  
       <li><figure class="thum2"><img width="50" height="50" src="<?php echo JEWISH_URL;?>/upload/<?php echo $forumdata[$ky][$i]['forum_author_image'] ; ?>" alt=""></figure>
       <h4><a href="<?php echo JEWISH_URL;?>/forum/<?php echo strtolower($ky); ?>/<?php echo $forumdata[$ky][$i]['forum_slug'] ; ?>"><?php echo $forumdata[$ky][$i]['forum_name'] ; ?></a><br><span><?php echo strtolower($ky); ?></span></h4>
       <h5><span><?php  echo $forumdata[$ky][$i]['forumcomment_count'] ;?></span><?php  echo $forumdata[$ky][$i]['forum_modified_date'] ;?></h5>
       </li>
       <?php } ?>
       
    </ul>
 
       <?php } ?>
</section>
</div>
<aside class="side-bar-right">
 <h2>Jewish Community Announcements</h2>
 <ul>
     <li>1 day ago<a href="#">Join Our Community Celebration!</a></li>
     <li>08 Apr, 2015<a href="#">Check Out Etsy's Redesigned 
Seller Handbook!</a></li>
     <li>08 Apr, 2015<a href="#">Check Out Etsy's Redesigned 
Seller Handbook!</a></li>
     <li>08 Apr, 2015<a href="#">Check Out Etsy's Redesigned 
Seller Handbook!</a></li>
     <li>08 Apr, 2015<a href="#">Check Out Etsy's Redesigned 
Seller Handbook!</a></li>
  </ul>

<h4><a href="#">Forums Guidelines</a><a href="#">Teams</a></h4>
</aside>



 <div class="clear"></div>
 </article>
</div>


 