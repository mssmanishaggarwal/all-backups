$(document).ready(function() {
    var baseUrl = $('#baseUrl').val();

    $('#error_msg').hide();
    //$('#main').hide();
    $('.spinner-loader').hide();
    $('.spinner-loader_edit').hide();
    $('.save_msg').hide();
    $('#client-table').hide();
    $('#master-file-form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                message: 'The first name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The first name is required'
                    },
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'The first name can consist of alphabetical characters and spaces only'
                    }
                }
            },
            
            last_name: {
                message: 'The last name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The last name is required'
                    },
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'The last name can consist of alphabetical characters and spaces only'
                    }
                }
            },

            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    }
                }
            }

        }
    });

/*$(document).on('click', '.disable_link', function(event) {
    event.preventDefault();
});*/
});

function Maphall(data){	
	var baseUrl = $('#baseUrl').val();
    var self = this;
    self.contact_email = ko.observable(data.contact_email);
    self.contact_mobile = ko.observable(data.contact_mobile);
    self.contact_name = ko.observable(data.contact_name);
    self.hall_address = ko.observable(data.hall_address);
    self.hall_city = ko.observable(data.hall_city);
    self.hall_country = ko.observable(data.hall_country);
    self.hall_description = ko.observable(data.hall_description);
    self.hall_name = ko.observable(data.hall_name);
    self.user_id = ko.observable(data.hall_name);
    self.location_id = ko.observable(data.hall_name);
}
function SelectLocation(data) {
    var self = this;
    self.location_id = ko.observable(data.location_id);
    self.location_name = ko.observable(data.location_name);

}
function SelectUser(data) {
    var self = this;
    self.user_id = ko.observable(data.id);
    self.email = ko.observable(data.email);

}
function SelectProvince(data) {
    var self = this;
    self.id = ko.observable(data.id);
    self.province_name = ko.observable(data.province_name);

}


 self.fetch_user= ko.observableArray();
 
var baseUrl = $('#baseUrl').val(); 
 $.ajax({
  url: baseUrl+"/admin/hall/selectuser",
  type: "GET",
  contentType: "application/json",
  accept: "application/json",
  success: function(result) {
     var map = $.map(result, function(item) {
        return new SelectUser(item);
    });
     self.fetch_user(map);
 }
});
 
   self.myOptions= ko.observableArray();

var baseUrl = $('#baseUrl').val();
 $.ajax({
  url: baseUrl+"/admin/hall/selectlocation",
  type: "GET",
  contentType: "application/json",
  accept: "application/json",
  success: function(result) {
     var map = $.map(result, function(item) {
        return new SelectLocation(item);
    });
     self.myOptions(map);
 }
});
 
self.provinceOptions=ko.observableArray();
  self.hall_type_checked=ko.observableArray();  

var baseUrl = $('#baseUrl').val();
 $.ajax({
  url: baseUrl+"/admin/hall/selectprovince",
  type: "GET",
  contentType: "application/json",
  accept: "application/json",
  success: function(result) {
     var map = $.map(result, function(item) {
        return new SelectProvince(item);
    });
     self.provinceOptions(map);
 }
});

 function SelectHallType(data) {
    var self = this;
    self.hall_type_id = ko.observable(data.hall_type_id);
    self.hall_type_name = ko.observable(data.hall_type_name);

}

 self.hall_type=ko.observableArray();

var baseUrl = $('#baseUrl').val();
 $.ajax({
  url: baseUrl+"/admin/hall/selechalltype",
  type: "GET",
  contentType: "application/json",
  accept: "application/json",
  success: function(result) {
     var map = $.map(result, function(item) {
        return new SelectHallType(item);
    });
     self.hall_type(map);
    // console.log(hall_type);
 }
});



    var baseUrl = $('#baseUrl').val();
    $(document).on('change','#user_id', function(emp){ var selectable=$('#user_id').val();//alert(selectable);
      if(selectable){
         $.ajax({
            url: baseUrl+'/admin/hall/fetch_user_data',
            data:JSON.stringify({'user_id':$(this).val()}),
            type: "POST",
            contentType: "application/json",
            accept: "application/json",
            dataType: "json",

        }).done(function(msg){
            $('#official_name').val(msg[0].first_name+' '+msg[0].last_name);
            $('#contact_name').val(msg[0].first_name+' '+msg[0].last_name);
            $('#contact_email').val(msg[0].email);
            $('#contact_mobile').val(msg[0].contact_number);
           // $('.display_user_details').slideDown('slow');
             
        });
   }else{
       // $('.display_user_details').slideUp('slow');
    }
});


function ClientViewModel(data){ 
    var self = this;
   
    ///self.locationOptions = ko.observableArray();

    self.hallList = ko.observableArray();  
    //console.log(hallList); 
    /*self.user_val=ko.observable();
    self.location_val=ko.observable();*/
    self.user_id = ko.observable();
    self.location_id = ko.observable();
   // self.hall_province = ko.observable();
    self.official_name = ko.observable();
    self.contact_name = ko.observable();
    self.contact_email = ko.observable();
    self.contact_mobile = ko.observable();
    self.hall_name = ko.observable();
    self.hall_description = ko.observable();
    self.hall_address = ko.observable();
    self.hall_city = ko.observable();
    self.hall_province = ko.observable();
    self.hall_postcode = ko.observable();
    self.hall_country = ko.observable();
    self.rental_amount = ko.observable();
    self.is_active = ko.observable();
    self.hall_type_checked=ko.observableArray();  
  //  self.location_val=ko.observable();
  //  self.user_val=ko.observable();
    var pathname = window.location.pathname,
        id = pathname.substring(pathname.lastIndexOf('/') + 1);

    var ajax_url ='';
    var ajax_update_url ='';
    if(id != 'hall'){
        ajax_url =baseUrl+"/admin/hall/"+id;
        ajax_update_url =baseUrl+"/admin/hall/update/"+id;
    }
    else{
        ajax_url =baseUrl+"/admin/hall";
    }
    if(id=='hall'){

        self.hallList = ko.observableArray();
        setTimeout(function(){ $('.spinner-loader_edit').hide(); $('#main').fadeIn('slow'); }, 500);

    }
    if(id != 'location' && id!='') { //alert();
        $('.spinner-loader_edit').show();
        $('#main').hide();
        setTimeout(function() {
        $.ajax({
            url: ajax_url,
            type: "GET",
            contentType: "application/json",
            accept: "application/json",
            dataType: "json",
            success: function (res) {            	
                /*var map = $.map(res, function (item) {
                    return new Maphall(item);
                });*/
                console.log(res);
            self.hallList(res);
            setTimeout(function(){ $('.spinner-loader_edit').hide(); $('#main').fadeIn('slow'); }, 500);

            }
        });
    }, 100);
    }


    self.save = function() {
        var validated = $("#master-file-form").data("bootstrapValidator");
        validated.isValid(), validated.validate();
        if(validated.isValid()) {
            var hall_type=[];
        	var user_id = $('#user_id').val();
        	var location_id = $('#location_id').val();
            var official_name =$('#official_name').val(); 
            var contact_name = $('#contact_name').val();
            var contact_email = $('#contact_email').val();
            var contact_mobile = $('#contact_mobile').val();
        	var hall_name = $('#hall_name').val();
            $("input[name='hall_type[]']:checked").each(function () {
                         hall_type.push(parseInt($(this).val()));
            });
        	var hall_description = $('#hall_description').val();
        	var hall_address = $('#hall_address').val();
        	var hall_city = $('#hall_city').val(); 
        	var hall_province = $('#hall_province').val(); 
        	var hall_postcode = $('#hall_postcode').val();
        	var hall_country = $('#hall_country').val();
        	var rental_amount = $('#rental_amount').val();      
            var is_active = '';           
            if($('#is_active').prop('checked'))
            	 is_active = 1;            	
            else
            	is_active = 0;
			
            $('.spinner-loader').show();
            $('.add_contact').attr('disabled', '');
            if (id != 'hall' && id != '') {
                 //alert(ajax_update_url);            

                $.ajax(ajax_update_url, {
                    data: JSON.stringify({
                        user_id:user_id,
                        location_id: location_id,
                        official_name:official_name,
                        contact_name:contact_name,
                        contact_email:contact_email,
                        contact_mobile:contact_mobile,
                        hall_name: hall_name,
                        hall_type:hall_type,
                        hall_description: hall_description,
                        hall_address: hall_address,
                        hall_city: hall_city,
                        hall_province: hall_province,
                        hall_postcode: hall_postcode,
                        hall_country: hall_country,
                        rental_amount: rental_amount,
                        is_active: is_active
                    }),
                    type: "PUT", contentType: 'application/json',
                    success: function (res) {

                        $('.spinner-loader').hide();
                        $('.save_msg').show().fadeOut(2000);
                        $('.add_contact').removeAttr('disabled');
                        //console.log(res);
                       setTimeout(function(){ window.location.href = baseUrl+'/admin/hall/uploadimage/'+res.data; }, 2000); 
                    }, errors: function (res) {
                        console.log('Error: ' + res);
                    }
                });
            }
            else{   
                /*$("input[name='hall_type[]']:checked").each(function () {
                         hall_type.push(parseInt($(this).val()));
                }); */        	
                $.ajax('hall/store', {
                    data: JSON.stringify({
                        user_id:user_id,
                        location_id: location_id,
                        official_name:official_name,
                        contact_name:contact_name,
                        contact_email:contact_email,
                        contact_mobile:contact_mobile,
                        hall_name: hall_name,
                        hall_type:hall_type,
                        hall_description: hall_description,
                        hall_address: hall_address,
                        hall_city: hall_city,
                        hall_province: hall_province,
                        hall_postcode: hall_postcode,
                        hall_country: hall_country,
                        rental_amount: rental_amount,
                        is_active: is_active
                    }),
                    type: "POST", contentType: 'application/json',
                    success: function (res) { //console.log(res);
                        $('.spinner-loader').hide();
                        $('.save_msg').show().fadeOut(2000);
                        $('.add_contact').removeAttr('disabled');
                        //console.log(res);
                       setTimeout(function(){ window.location.href = baseUrl+'/admin/hall/uploadimage/'+res.data; }, 2000); 
                    }, errors: function (res) {
                        console.log('Error: ' + res);
                    }
                });
            }
        }


    };

	self.cancel = function() {
    		 window.location.href = baseUrl+'/admin/hall_list';
    	};


        /*==================*/


}


ko.applyBindings(new ClientViewModel());