$( window ).load(function() {
	var baseUrl = $('#baseUrl').val();
	var page_id=$('.tab-content').data('page');
	$.ajax({
		url: baseUrl+"/admin/hall/selectaccommodation",
		type: "GET",
		contentType: "application/json",
		accept: "application/json",
		success: function(result) {
		$('.box-body').html('<div class="form-group"><label class="col-sm-2 text-left"><span class="fa  fa-check-square-o"></span> <b>Name</b></label><div class="col-sm-2 text-left"><label>Quantity</label></div></div>');
			for(var key in result){
     	//console.log(result[key]);
     	$('.box-body').append('<div class="form-group"><div class="col-sm-2"> <div class="checkbox"><label><input type="checkbox" class=""  name="addon_id[]" id="hall_id_'+result[key].accommodation_id+'" value="'+result[key].id+'">'+result[key].accommodation_name+'</label></div></div><div class="col-sm-1 text-left"><select id="acc_id_'+result[key].accommodation_id+'" name="quantity[]" class="form-control"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></div></div>');
     
     }checker();
 }
});
	
});	 
function checker(){
	var baseUrl = $('#baseUrl').val();
	var page_id=$('.tab-content').data('page');
	$.ajax({
		url: baseUrl+"/admin/hall/accommodationchecker",
		data:{hall_id:page_id},
		type: "POST",
		dataType: "application/json",
		accept: "application/json",
	}).done(function(res){
		console.log(res);
	}).error(function(err){
		var get=$.parseJSON(err.responseText);
		///console.log(get);
		for(var key in get){
			$('#hall_id_'+get[key].accommodation_id).attr('checked', 'checked');
			$('#acc_id_'+get[key].accommodation_id+' option[value='+get[key].accommodation_number+']').attr('selected','selected');
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
	var accommodation_ids = [];
	var accommodation_numbers = [];
	$("input[name='addon_id[]']:checked").each(function ()
	{
		accommodation_ids.push(parseInt($(this).val()));
		accommodation_numbers.push(parseInt($('#acc_id_'+$(this).val()).val()));
	}); 
	var tot_data={hall_id:hall_id,accommodation_id:accommodation_ids,accommodation_number:accommodation_numbers};
	console.log(tot_data);
	$.ajax({
		url: baseUrl+"/admin/hall/insrtaccommodation",
		data:tot_data,
		type: "POST",
		dataType: "application/json",
		     
}).error(function(err){
		var get=$.parseJSON(err.responseText);//console.log(get.hall_id);
		setTimeout(function() {window.location.href=baseUrl+'/admin/hall_list';},100);
	});
	
});

jQuery(document).ready(function($) {
   
 $('.btn-default').click(function(){ 
      var baseUrl = $('#baseUrl').val();
     window.location.href = baseUrl+'/admin/hall_list';
});   
});

