function ManagerGeneral(url){	
		$('#TransMsgDisplay').html('<img src="'+base_url+'assets/admin/images/indicator.gif" align="center">');	
		$.ajax({
				type: "POST",
				url: url,				
				dataType: 'html',				
				success: function(data){	
					//alert(data);
						$('#records_listing').html(data);			
						if($('#TransMsgDisplay')){
							$('#TransMsgDisplay').html('');
						}
				}
		});

}
