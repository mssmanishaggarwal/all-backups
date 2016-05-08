<script>console.log('view/business_directory/directory.php')</script>
<link rel="stylesheet" href="<?php echo JEWISH_URL;?>/css/business.css">
<div class="container">
 <article class="page-content">
  <ul class="page-nav">
    <li><a href="<?php echo JEWISH_URL;?>">homepage></a></li>
    <li><a href="<?php echo JEWISH_URL;?>/business_directory/">Business Directory</a></li>
  </ul>
  <p></p>
<ul class="page-alpha">
 <li>Category Directory</li>
 <li><a href="?alpha=A">A</a></li>
 <li><a href="?alpha=B">B</a></li>
 <li><a href="?alpha=C">C</a></li>
 <li><a href="?alpha=D">D</a></li>
 <li><a href="?alpha=E">E</a></li>
 <li><a href="?alpha=F">F</a></li>
 <li><a href="?alpha=G">G</a></li>
 <li><a href="?alpha=H">H</a></li>
 <li><a href="?alpha=I">I</a></li>
 <li><a href="?alpha=J">J</a></li>
 <li><a href="?alpha=K">K</a></li>
 <li><a href="?alpha=L">L</a></li>
 <li><a href="?alpha=M">M</a></li>
 <li><a href="?alpha=N">N</a></li>
 <li><a href="?alpha=O">O</a></li>
 <li><a href="?alpha=P">P</a></li>
 <li><a href="?alpha=Q">Q</a></li>
 <li><a href="?alpha=R">R</a></li>
 <li><a href="?alpha=S">S</a></li>
 <li><a href="?alpha=T">T</a></li>
 <li><a href="?alpha=U">U</a></li>
 <li><a href="?alpha=V">V</a></li>
 <li><a href="?alpha=W">W</a></li>
 <li><a href="?alpha=X">X</a></li>
 <li><a href="?alpha=Y">Y</a></li>
 <li><a href="?alpha=Z">Z</a></li>
</ul>
<!--<ul class="alpha-heading">
<li>A</li>
<li><a href="#">Others</a></li>
<li><a href="index.html">Attorneys</a></li>
<li><a href="#">Auto Repair</a></li>
<li><a href="#">Auto Sales & Leasing</a></li>
</ul>
<ul class="alpha-heading">
<li>B</li>
<li><a href="#">Others</a></li>
<li><a href="index.html">Attorneys</a></li>
<li><a href="#">Auto Repair</a></li>
<li><a href="#">Auto Sales & Leasing</a></li>
</ul>
<ul class="alpha-heading">
<li>C</li>
<li><a href="#">Others</a></li>
<li><a href="index.html">Attorneys</a></li>
<li><a href="#">Auto Repair</a></li>
<li><a href="#">Auto Sales & Leasing</a></li>
</ul>
<ul class="alpha-heading">
<li>D</li>
<li><a href="#">Others</a></li>
<li><a href="index.html">Attorneys</a></li>
<li><a href="#">Auto Repair</a></li>
<li><a href="#">Auto Sales & Leasing</a></li>
</ul>
<ul class="alpha-heading">
<li>E</li>
<li><a href="#">Others</a></li>
<li><a href="index.html">Attorneys</a></li>
<li><a href="#">Auto Repair</a></li>
<li><a href="#">Auto Sales & Leasing</a></li>
</ul>
<ul class="alpha-heading">
<li>F</li>
<li><a href="#">Others</a></li>
<li><a href="index.html">Attorneys</a></li>
<li><a href="#">Auto Repair</a></li>
<li><a href="#">Auto Sales & Leasing</a></li>
</ul>
<ul class="alpha-heading">
<li>G</li>
<li><a href="#">Others</a></li>
<li><a href="index.html">Attorneys</a></li>
<li><a href="#">Auto Repair</a></li>
<li><a href="#">Auto Sales & Leasing</a></li>
</ul>
<ul class="alpha-heading">
<li>H</li>
<li><a href="#">Others</a></li>
<li><a href="index.html">Attorneys</a></li>
<li><a href="#">Auto Repair</a></li>
<li><a href="#">Auto Sales & Leasing</a></li>
</ul>-->
<?php
if(isset($_GET['alpha']) && !empty($_GET['alpha'])){?>
<ul class="business-listing">
<?php  
    $alpha=$_GET['alpha'];
	$count=1;
	$query = $this->db->query("SELECT * FROM `bd_categories` WHERE `category_name` like '$alpha%'");
	$data = $query->result_array();
	foreach ( $data as $v){
?>
<li><a href="<?php echo JEWISH_URL;?>/business_directory/business_list/<?php echo urlencode($v['category_name']);?>/<?php  
echo $this->allencode->encode($v['id']);?>/1"><?php  echo $v['category_name'];?></a></li>
<?php   
if($count==15){ echo '</ul><ul class="business-listing">';}else if($count==30){ echo '</ul><ul class="business-listing">';}
$count++; }?>
</ul>
<?php }else{ ?>
<ul class="business-listing">
<?php  
	$count=1;
	$query = $this->db->query("SELECT * FROM `bd_categories` ORDER BY `category_name` ASC");
	$data = $query->result_array();
	foreach ( $data as $v){
?>
<li><a href="<?php echo JEWISH_URL;?>/business_directory/business_list/<?php echo urlencode($v['category_name']);?>/<?php  
echo $this->allencode->encode($v['id']);?>/1"><?php  echo $v['category_name'];?></a></li>
<?php 
if($count==15){ echo '</ul><ul class="business-listing">';}else if($count==30){ echo '</ul><ul class="business-listing">';}
$count++; }?>
</ul>
<?php } ?>

 <div class="clear"></div>
 </article>
</div>