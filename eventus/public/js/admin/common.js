  $(function() {
    $( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd"
	});
  });
function setActive(urllink, id, currentvalue){
	$('.overlay').show();
	var keyset = $('#searchfrm').serialize();	
	var baselink = $('#linkUrl').val();
	 $.ajax({
      url:baselink+urllink,
	  method:'POST',
	  data:{dataid:id,currentval:currentvalue}, 
      success:function(dataset) {
			$('#recordset').html(dataset);
			$('.overlay').hide();
      }
   });
}
function ordering(urllink, order_by, field_name){
	$('.overlay').show();
	var baselink = $('#linkUrl').val();
	 $.ajax({
      url:baselink+urllink,
	  method:'POST',
	  data:{orderby:order_by,fieldname:field_name}, 
      success:function(dataset) {	  		
			$('#recordset').html(dataset);
			$('#accommodation_name').removeClass('text-muted');
			$('.overlay').hide();
      }
   });
}
function searching(urllink){
	$('.overlay').show();
	var baselink = $('#linkUrl').val();
	var keyset = $('#searchfrm').serialize();	
	 $.ajax({
      url:baselink+urllink,
	  method:'POST',
	  data:keyset, 
      success:function(dataset) {
			$('#recordset').html(dataset);
			$('.overlay').hide();
      }
   });
}
function currencySearch(urllink, currencyid){
	$('.overlay').show();
	var baselink = $('#linkUrl').val();
	if(currencyid==1){
		$('#curr').html('AOA');
	}else{
		$('#curr').html('Euro');
	}
	 $.ajax({
      url:baselink+urllink,
	  method:'POST',
	  data:{cid:currencyid}, 
      success:function(dataset) {
			$('#recordset').html(dataset);
			$('.overlay').hide();
      }
   });
}
function resetorder(urllink,id, currorder){
	$('.overlay').show();
	var baselink = $('#linkUrl').val();
	 $.ajax({
      url:baselink+urllink,
	  method:'POST',
	  data:{dataid:id,noworder:currorder}, 
      success:function(dataset) {
			$('#recordset').html(dataset);
			$('.overlay').hide();
      }
   });
}
function funcPagenation(currpg,limitdt){	
	$('.overlay').show();
	var baselink = $('#linkUrl').val();
		$.ajax({
				type: "POST",
				url: baselink+'paging',
				data: {limit:limitdt,currpage:currpg},
				dataType: 'html',
				success: function(dataset){					
					$("#recordset").html(dataset);
					$('.overlay').hide();					
				}
			});
		
}
function setRecordPerPage(urllink,numrec){
	$('.overlay').show();
	var baselink = $('#linkUrl').val();
		$.ajax({
				type: "POST",
				url: baselink+urllink,
				data: {limit:numrec},
				dataType: 'html',
				success: function(dataset){					
					$("#recordset").html(dataset);
					$('.overlay').hide();					
				}
			});
}
function updatedata(urllink, frmname, returnurl) {
	$('.overlay').show();	
	tinyMCE.triggerSave();
	var dataset = $('#'+frmname).serialize();
	//console.log(dataset);
	 $.ajax({
      url:urllink,
	  method:'POST',
	  data:dataset, 
      success:function(dataset) {
			if(dataset==1){
				document.location.href=returnurl;
			}else{
				alert('Error');
			}
			$('.overlay').hide();
		}	 
   });
}

function updateUserdata(urllink, frmname, returnurl) {
	$('.overlay').show();	
	tinyMCE.triggerSave();
	var dataset = $('#'+frmname).serialize();
	//console.log(dataset);
	 $.ajax({
      url:urllink,
	  method:'POST',
	  data:dataset, 
      success:function(dataset) {
			if(dataset==1){
				document.location.href=returnurl;
			}else{
				alert('Error');
			}
			$('.overlay').hide();
		}	 
   }).error(function(re){			
                var returnable=$.parseJSON(re.responseText);
                for(var key in returnable){                             	
                	if(key == 'email')
                 	$('.duplicate_email').html('<span class="error_pass">'+returnable[key]+'</span>');
                 	if(key == 'contact_number')
                 	$('.duplicate_password').html('<span class="error_pass">'+returnable[key]+'</span>');
                 	$('.overlay').hide();
                }
    });
}

function deletedata(urllink,id){
	bootbox.confirm("Are you sure want to delete this record?", function(result)
	{
        if (result == true){
	        $('.overlay').show();
			var baselink = $('#linkUrl').val();
			$.ajax({
		        url: baselink+urllink,
				data:{dataid:id},
		  		method:'post',
		        success: function(dataset) {
						$("#recordset").html(dataset);
						$('.overlay').hide();
					}
				});
		}
  	});
}
