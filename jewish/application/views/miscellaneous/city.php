<script>console.log('miscellaneous/city.php')</script>
<div class="container">
<article class="page-content">

 <h1 class="sel_city">Please select a city</h1>  
 <ul class="city-listing">
 <?php $get_city=$this->citymod->fetch_city();
 		$count=1;
	  foreach($get_city as $v){?>
      <li><a href="#" data-city="<?php echo $v['id']?>"><?php echo $v['name']?></a></li>
      <?php 
	  if($count==12){ echo '</ul><ul class="city-listing">';}
	  else if($count==24){ echo '</ul><ul class="city-listing">';}
	  else if($count==36){ echo '</ul><ul class="city-listing">';}
	  /*else if($count==32){ echo '</ul><ul class="city-listing">';}
	  else if($count==40){ echo '</ul><ul class="city-listing">';}*/
$count++; }?>
   
  </ul> 
<script>
$(document).ready(function() {
    $('.city-listing > li >a').on('click',function(kaushik){
		kaushik.preventDefault();
		$('#city_id').val($(this).data('city'));
		$('#hiddenone').submit();
		});
});
</script>
 <form id="hiddenone" method="post" action="<?php echo JEWISH_URL;?>/main/city_change/?&redirect=<?php echo $_GET['redirect'];?>">
 <input type="hidden" name="city_id" id="city_id" value="">
 </form> 
 <div class="clear"></div>
 </article>
</div>
<style>
#hiddenone{
	display:none;
}
 .city-listing{ 
   width: 20%;
    font-family: 'SegoeUIRegular';
  float: left;
  padding: 20px;
 }
 .city-listing li { 
   padding: 5px 0px;
 }
 .city-listing li a {
  color: #3c3b3b;
  font-weight: normal;
}
ol, ul {
  list-style: none;
}
.sel_city{
color: #57e2ca;
  font-weight: bold;
  font-family: 'SegoeUIRegular';
  font-size: 25px;
  text-align: center;
  margin-top: 12px;
}
</style>