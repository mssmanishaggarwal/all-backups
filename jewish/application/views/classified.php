<script>console.log('view/classified.php')</script>
<div class="container">
 <article class="page-content">
 	<ul class="page-nav">
    <li><a href="<?php echo JEWISH_URL;?>">homepage></a></li>
    <li><a href="<?php echo JEWISH_URL;?>/classified/<?php echo $type?>/"> <?php echo $type?></a></li>
  </ul>
  <?php if($type=='housing'){?>
  <div class="housing">
                
        <div id="hhh" class="col">
        <h4 class="ban"><span class="txtr">Housing<sup class="c"></sup></span></h4>
        <div class="cats">
    <ul id="hhh0">
 <?php  
		$q_m=$this->db->get_where('categories', array('type' => 'housing','parent  !='=>0));
		 foreach($q_m->result_array() as $k=>$v){ ?>
<li><a href="<?php echo JEWISH_URL;?>/classified/search/<?php echo $v['type']?>/?cat_id=<?php echo $v['id']?>" class="apa" data-cat="apa"><span class="txt"><?php echo $v['category_name']?><sup class="c"></sup></span></a></li>
<?php }
 
?>

</ul>
</div>
</div>
            </div>
  <?php }else if($type=='job'){ ?>
    <div class="housing">
                
        <div id="hhh" class="col">
        <h4 class="ban"><span class="txt">Job<sup class="c"></sup></span></h4>
        <div class="cats">
    <ul id="hhh0">
 <?php  
		$q_m=$this->db->get_where('categories', array('type' => 'job','parent  !='=>0));
		 foreach($q_m->result_array() as $k=>$v){ ?>
<li><a href="<?php echo JEWISH_URL;?>/classified/search/<?php echo $v['type']?>/?cat_id=<?php echo $v['id']?>" class="apa" data-cat="apa"><span class="txt"><?php echo $v['category_name']?><sup class="c"></sup></span></a></li>
<?php }
 
?>

</ul>
</div>
</div>
            </div> 
   <?php }else if($type=='event'){ ?>         
            <div class="housing">
                
        <div id="hhh" class="col">
        <h4 class="ban"><span class="txt">Event<sup class="c"></sup></span></h4>
        <div class="cats">
    <ul id="hhh0">
 <?php  
		$q_m=$this->db->get_where('categories', array('type' => 'event','parent  !='=>0));
		 foreach($q_m->result_array() as $k=>$v){ ?>
<li><a href="<?php echo JEWISH_URL;?>/classified/search/<?php echo $v['type']?>/?cat_id=<?php echo $v['id']?>" class="apa" data-cat="apa"><span class="txt"><?php echo $v['category_name']?><sup class="c"></sup></span></a></li>
<?php }
 
?>

</ul>
</div>
</div>
            </div>  
    <?php } ?>             
 </article>
 </div>