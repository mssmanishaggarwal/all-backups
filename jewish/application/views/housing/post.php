<script>console.log('view/housing/post.php')</script>
<script>
$(document).ready(function() {
    var type='<?php echo $type;?>';
	if(type=='housing'){
	   var t="<?php echo JEWISH_URL;?>/post/addhousingpost";
	}else if(type=='job')
	{ 
		 var t="<?php echo JEWISH_URL;?>/post/addjobpost";
	}else if(type=='event')
	{ 
		 var t="<?php echo JEWISH_URL;?>/post/addeventpost";
	}
	$('#type_postr').attr('action',t);
	$('#preface').attr('action',t);
	$('#parent_id').on('change click',function(e){ //alert(e.which+e.typ);
	e.preventDefault();
	if($(this).val()!=''){	
	$.ajax({
                      url: '<?php echo JEWISH_URL;?>'+'/classified/get_children/',  
                      type: 'POST',
					  data: $('#preface').serialize(),
                      success: function(data){
						  		$('#children').fadeIn(500);
								$('#children').html(data);
                             }
                  });
	}else{
		$('#children').hide();
	}
	});		  
});
</script>


<div class="container">
<article class="page-content">
<section class="body" <?php if(!isset($type)){ echo 'style="display:none;"';}?>>



<?php if($type=='housing'){?>
				<div class="center_align">
                      <p class="formnote">
                       <b style="font-size:20px;">Select  a <?php echo $type;?> category</b>
                      </p>
                      <form method="post" id="preface" >
                      <div class="stylish_combi">
                      <select name="parent_id" id="parent_id">
                      <option value="">Please Select</option>
                      <?php 
                      $query = $this->db->query("SELECT id, category_name FROM categories WHERE type='".$type."' AND parent=0");
                      foreach ($query->result_array() as $row){
                      ?>
                      <option value="<?php echo $row['id']?>"><?php echo ucwords($row['category_name'])?></option>
                      <?php } ?>
                       </select>      
                      </div>
                       <div class="stylish_combi" id="children" style="display:none;">
                       </div> 
                       </form>
               </div>    
<?php	}else{?>
              <div class="center_align">   
					<?php $attributes = array('id' => 'type_postr');
									   echo form_open('post/addhousingpost', $attributes);
									   ?>
					<p class="formnote">
					<b style="font-size:20px;">Select  a <?php echo $type;?> category</b>
					</p>
					<div class="stylish_combi">
					<select name="child_id" onchange="this.form.submit();">
					<option value="">Select <?php echo $type;?> category</option>
					<?php 
					$query = $this->db->query("SELECT id, category_name FROM categories WHERE type='".$type."' AND parent!=0");
					foreach ($query->result_array() as $row){
						?>
					<option value="<?php echo $row['id']?>"><?php echo ucwords($row['category_name'])?></option>
					<?php } ?>
					</select>      
					</div>                 
					<?php echo form_close(); ?>
               </div> 
<?php } ?>
</section>
</article>
</div>
<style>
.stylish_combi {
	font-family:'SegoeUIRegular';
     padding: 0;
  margin: 8px;
  border: 1px solid #ccc;
  width: 336px;
  border-radius: 3px;
  overflow: hidden;
  background-color: #fff;
  background: #fff url("http://www.scottgood.com/jsg/blog.nsf/images/arrowdown.gif") no-repeat 100% 50%;
}

.stylish_combi select {
	font-family:'SegoeUIRegular';
    padding: 5px 8px;
    width: 100%;
    border: none;
    box-shadow: none;
    background-color: transparent;
    background-image: none;
    -webkit-appearance: none;
       -moz-appearance: none;
            appearance: none;
}

.stylish_combi select:focus {
	font-family:'SegoeUIRegular';
    outline: none;
}
</style>