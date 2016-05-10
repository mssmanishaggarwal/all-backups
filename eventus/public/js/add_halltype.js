$(document).ready(function() {
    $('#error_msg').hide();
    $('#main').hide();
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
            name: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The name is required'
                    },
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'The name can consist of alphabetical characters and spaces only'
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
            }

        }
    });


});

function MapUser(data){	
	var baseUrl = $('#baseUrl').val();
    var self = this;
    self.id = ko.observable(data.id);   
    self.hall_type_name = ko.observable(data.hall_type_name);
    
    /* $.ajax({
            url: baseUrl+'/admin/showLanguage',
            type: "GET",
            contentType: "application/json",
            accept: "application/json",
            dataType: "json",
            success: function (res) {               
               for(var key in res) {
                     var value = res[key];
					
					//self.hall_type_name_+value.id = ko.observable(data.hall_type_name).extend({ required: true}); 
					
					self.hall_type_name = ko.computed(function() {
						
    return self.hall_type_name()+'_'+value.id;
});
console.log(self.hall_type_name);
                }
            }
        });*/
    //self.hall_type_name = ko.observable(data.name);   
}


function ClientViewModel(data){
    var baseUrl = $('#baseUrl').val();

    var self = this;
    self.hallTypelist = ko.observableArray();
    self.hall_type_name_1 = ko.observable();
    self.hall_type_name_2 = ko.observable();
      
    var pathname = window.location.pathname,
        id = pathname.substring(pathname.lastIndexOf('/') + 1);

    var ajax_url ='';
    var ajax_update_url ='';
    if(id != 'halltype'){
        ajax_url =baseUrl+"/admin/halltype/"+id;
        ajax_update_url =baseUrl+"/admin/halltype/update/"+id;
    }
    else{
        ajax_url =baseUrl+"/halltype";
    }
    if(id=='halltype'){

        self.hallTypelist = ko.observableArray();
        setTimeout(function(){ $('.spinner-loader_edit').hide(); $('#main').fadeIn('slow'); }, 500);

    }
    if(id != 'halltype' && id!='') {
        $('.spinner-loader_edit').show();
        $('#main').hide();
        $.ajax({
            url: ajax_url,
            type: "GET",
            contentType: "application/json",
            accept: "application/json",
            dataType: "json",
            success: function (res) {            	
                /*var map = $.map(res, function (item) {
                    return new MapUser(item);
                });*/
            self.hallTypelist(res);
            
            setTimeout(function(){ $('.spinner-loader_edit').hide(); $('#main').fadeIn('slow'); }, 500);

            }
        });
    }


    self.save = function() {
        var validated = $("#master-file-form").data("bootstrapValidator");
        validated.isValid(), validated.validate();
        if(validated.isValid()) {
        	
        	var hall_type_name_1 = $('#hall_type_name_1').val();
            var hall_type_name_2 = $('#hall_type_name_2').val(); 
            var is_active = '';           
            if($('#is_active').prop('checked'))
            	 is_active = 1;            	
            else
            	is_active = 0;
			
            $('.spinner-loader').show();
            $('.add_contact').attr('disabled', '');
            if (id != 'halltype' && id != '') {
                             

                $.ajax(ajax_update_url, {
                    data: JSON.stringify({
                        hall_type_name_1: hall_type_name_1,
                        hall_type_name_2: hall_type_name_2,
                        is_active: is_active
                    }),
                    type: "PUT", contentType: 'application/json',
                    success: function (res) {

                        $('.spinner-loader').hide();
                        $('.save_msg').show().fadeOut(2000);
                        $('.add_contact').removeAttr('disabled');
                        setTimeout(function(){ window.location.href = baseUrl+'/admin/halltype_list'; }, 2000);  
                    }, errors: function (res) {
                        console.log('Error: ' + res);
                    }
                });
            }
            else{            	
                $.ajax('halltype/store', {
                    data: JSON.stringify({
                        hall_type_name_1: hall_type_name_1,
                        hall_type_name_2: hall_type_name_2,
                        is_active: is_active
                    }),
                    type: "POST", contentType: 'application/json',
                    success: function (res) {
                        $('.spinner-loader').hide();
                        $('.save_msg').show().fadeOut(2000);
                        $('.add_contact').removeAttr('disabled'); 
                           
                        setTimeout(function(){ window.location.href = baseUrl+'/admin/halltype_list'; }, 2000);                    
                    }, errors: function (res) {
                        console.log('Error: ' + res);
                    }
                });
            }
        }
    };
    
    self.cancel = function() {
    		 window.location.href = baseUrl+'/admin/halltype_list';
    	};

}

ko.applyBindings(new ClientViewModel());