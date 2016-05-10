$( window ).load(function() {
	var baseUrl = $('#baseUrl').val();
	var page_id=$('.tab-content').data('page');
	$.ajax({
		url: baseUrl+"/admin/hall/selectaddon",
		type: "GET",
		contentType: "application/json",
		accept: "application/json",
		success: function(result) {
			$('.box-body').html('<div class="form-group"><label class="col-sm-2 text-left"><span class="fa  fa-check-square-o"></span> <b>Name</b></label><div class="col-sm-2 text-right"><label>Price</label><span class="text-muted"> (AOA)</span></div></div>');
			for(var key in result){
     	//console.log(result[key]);
     	$('.box-body').append('<div class="form-group"><div class="col-sm-2"> <div class="checkbox"><label><input type="checkbox" class=""  name="addon_id[]" id="hall_id_'+result[key].addon_id+'" value="'+result[key].id+'"> '+result[key].addon_name+'</label></div></div><div class="col-sm-2 text-right"><input id="addon_price_id_'+result[key].addon_id+'" type="test" name="addon_price[]" class="form-control text-right" value=""/></div></div>');
    	
     }checker();
    }
  });

});	

function checker(){
	var baseUrl = $('#baseUrl').val();
	var page_id=$('.tab-content').data('page'); 
	$.ajax({
		url: baseUrl+"/admin/hall/addonchecker",
		data:{hall_id:page_id},
		type: "POST",
		dataType: "application/json",
		accept: "application/json",
	}).done(function(res){
		console.log(res);
	}).error(function(err){
		var get=$.parseJSON(err.responseText);
		for(var key in get){
			$('#hall_id_'+get[key].addon_id).attr('checked', 'checked');
			$('#addon_price_id_'+get[key].addon_id).val(parseInt(get[key].addon_price));
		}
	});
}


/*setTimeout(function() {*/
	
/*}, 18);*/


/*$( window ).load(function() {
	
});*/

$(document).on('submit', '#master-file-form', function(event) {
	event.preventDefault();
	var baseUrl = $('#baseUrl').val();
	var hall_id=$('.tab-content').data('page');
	var addon_ids = [];
	var addon_prices = [];
	$("input[name='addon_id[]']:checked").each(function ()
	{
		addon_ids.push(parseInt($(this).val()));
		addon_prices.push(parseInt($('#addon_price_id_'+$(this).val()).val()));
	}); 
	$.ajax({
		url: baseUrl+"/admin/hall/insrtaddon",
		data:{hall_id:hall_id,addon_id:addon_ids,addon_price:addon_prices},
		type: "POST",
		dataType: "application/json",
		     
}).error(function(err){
		var get=$.parseJSON(err.responseText);//console.log(get.hall_id);
		window.location.href=baseUrl+'/admin/hall/accommodation/'+get.hall_id;
	});
	
});

jQuery(document).ready(function($) {
   
 $('.btn-default').click(function(){ 
      var baseUrl = $('#baseUrl').val();
     window.location.href = baseUrl+'/admin/hall_list';
});   
});

