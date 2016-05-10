$( window ).load(function() {
    var baseUrl = $('#baseUrl').val();
    var page_id=$('.tab-content').data('page');
    $.ajax({
        url: baseUrl+"/admin/hall/displayimages",
        data:{hall_id:page_id},
        type: "GET",
        contentType: "application/json",
        accept: "application/json",
        success: function(result) { console.log(result);
            for(var key in result){
        //console.log(result[key]);
        $('.image_container').append('<div class = "col-xs-6 col-sm-4  col-md-3"><div class = "thumbnail"><a href="#" class="hall_img" data-imgname="'+result[key].hall_image+'" data-imgid="'+result[key].id+'" data-hallid="'+page_id+'"><span class="fa fa-times"></span></a><img src = "'+baseUrl+'/public/uploads/'+result[key].hall_image+'" height="200" width="300" alt = ""></div></div>');
    }
}
});
});

 $(document).on('click', '.hall_img', function(ev) { //alert();
    if(confirm('Are you want to delete this picture?')){
    ev.preventDefault();
    var baseUrl = $('#baseUrl').val();
    var img_id=$(this).data('imgid');
    var hall_id=$(this).data('hallid');
    var imgname=$(this).data('imgname');
    $.ajax({
        url: baseUrl+"/admin/hall/deleteimage",
        data:{hall_id:hall_id,img_id:img_id,imgname:imgname}, 
        type: "POST",
        dataType: "application/json",

    }).error(function(err){
        var get=$.parseJSON(err.responseText);//console.log(get.hall_id);
        window.location.href=baseUrl+'/admin/hall/set-location/'+get.hall_id;
    });
}else{
    return false;
}
});   
jQuery(document).ready(function($) {
   
 $('.btn-default').click(function(){ 
      var baseUrl = $('#baseUrl').val();
     window.location.href = baseUrl+'/admin/hall_list';
});   
});


/*setTimeout(function() {
    var baseUrl = $('#baseUrl').val();
    var page_id=$('.tab-content').data('page');
    $.ajax({
        url: baseUrl+"/admin/hall/addonchecker",
        data:{hall_id:page_id},
        type: "POST",
        dataType: "application/json",
    }).done(function(res){
        console.log(res);
    }).error(function(err){
        var get=$.parseJSON(err.responseText);
        for(var key in get){
            $('#hall_id_'+get[key].addon_id).attr('checked', 'checked');
        }
    });
}, 18);*/


/*$( window ).load(function() {
    
});*/

/*$(document).on('submit', '#master-file-form', function(event) {
    event.preventDefault();
    var baseUrl = $('#baseUrl').val();
    var hall_id=$('.tab-content').data('page');
    var addon_ids = [];
    $("input[name='addon_id[]']:checked").each(function ()
    {
        addon_ids.push(parseInt($(this).val()));
    }); 
    $.ajax({
        url: baseUrl+"/admin/hall/insrtaddon",
        data:{hall_id:hall_id,addon_id:addon_ids},
        type: "POST",
        dataType: "application/json",
             
}).error(function(err){
        var get=$.parseJSON(err.responseText);//console.log(get.hall_id);
        window.location.href=baseUrl+'/admin/hall/accommodation/'+get.hall_id;
    });
    
});*/

