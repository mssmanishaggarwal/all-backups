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
            },
            
             cnf_password: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required'
                    },
                    identical: {
                    field: 'password',
                    message: 'The password and its confirm password are not the same'
                	}
                }
            },
            
            address: {
                validators: {
                    notEmpty: {
                        message: 'The address is required'
                    }
                }
            },
            
            contact_number: {
                validators: {
                    notEmpty: {
                        message: 'The mobile no. is required'
                    }
                }
            },
            
            city: {
                validators: {
                    notEmpty: {
                        message: 'The city is required'
                    }
                }
            },
            
            state: {
                validators: {
                    notEmpty: {
                        message: 'The province is required'
                    }
                }
            }

        }
    });


});

function MapUser(data){	
	var baseUrl = $('#baseUrl').val();
    var self = this;
}




function ClientViewModel(data){
    var baseUrl = $('#baseUrl').val();

    var self = this;
    self.userList = ko.observableArray();   
    self.first_name = ko.observable();
    self.last_name = ko.observable();
    self.email = ko.observable();
    self.password = ko.observable();
    self.contact_number = ko.observable();
    self.address = ko.observable();
    self.city = ko.observable();
    self.state = ko.observable();
    self.postcode = ko.observable();
    self.country = ko.observable();
    self.is_active = ko.observable();
      
    var pathname = window.location.pathname,
        id = pathname.substring(pathname.lastIndexOf('/') + 1);

    var ajax_url ='';
    var ajax_update_url ='';
    if(id != 'user'){
        ajax_url =baseUrl+"/admin/user/"+id;
        ajax_update_url =baseUrl+"/admin/user/update/"+id;
    }
    else{
        ajax_url =baseUrl+"/admin/user";
    }
    if(id=='user'){

        self.userList = ko.observableArray();
        setTimeout(function(){ $('.spinner-loader_edit').hide(); $('#main').fadeIn('slow'); }, 500);

    }
    if(id != 'user' && id!='') {
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
            self.userList(res);
            
            setTimeout(function(){ $('.spinner-loader_edit').hide(); $('#main').fadeIn('slow'); }, 500);

            }
        });
    }


    self.save = function() {
        var validated = $("#master-file-form").data("bootstrapValidator");
        validated.isValid(), validated.validate();
        if(validated.isValid()) {
        	var first_name = $('#first_name').val();        	   	
        	var last_name = $('#last_name').val();
        	var email = $('#email').val();
        	var password = $('#password').val();
        	var contact_number = $('#contact_number').val();
        	var address = $('#address').val();
        	var city = $('#city').val();
        	var state = $('#state').val();
        	var postcode = $('#postcode').val();
        	var country = $('#country').val();     
            var is_active = '';           
            if($('#is_active').prop('checked'))
            	 is_active = 1;            	
            else
            	is_active = 0;
			
            $('.spinner-loader').show();
            $('.add_contact').attr('disabled', '');
            if (id != 'user' && id != '') {
                             

                $.ajax(ajax_update_url, {
                    data: JSON.stringify({
                        first_name: first_name,
                        last_name: last_name,
                        email: email,                        
                        contact_number: contact_number,
                        address: address,
                        city: city,
                        state: state,
                        postcode: postcode,
                        country: country,
                        is_active: is_active
                    }),
                    type: "PUT", contentType: 'application/json',
                    success: function (res) {

                        $('.spinner-loader').hide();
                        $('.save_msg').show().fadeOut(2000);
                        $('.add_contact').removeAttr('disabled');
                        setTimeout(function(){ window.location.href = baseUrl+'/admin/user_list'; }, 2000); 
                    }, errors: function (res) {
                        console.log('Error: ' + res);
                    }
                });
            }
            else{            	
                $.ajax('user/store', {
                    data: JSON.stringify({
                        first_name: first_name,
                        last_name: last_name,
                        email: email,
                        password: password,
                        contact_number: contact_number,
                        address: address,
                        city: city,
                        state: state,
                        postcode: postcode,
                        country: country,
                        is_active: is_active
                    }),
                    type: "POST", contentType: 'application/json',
                    success: function (res) {
                        $('.spinner-loader').hide();
                        $('.save_msg').show().fadeOut(2000);
                        $('.add_contact').removeAttr('disabled');
                        setTimeout(function(){ window.location.href = baseUrl+'/admin/user_list'; }, 2000); 
                    }, errors: function (res) {
                        console.log('Error: ' + res);
                    }
                });
            }
        }
    };

	self.cancel = function() {
    		 window.location.href = baseUrl+'/admin/user_list';
    	};

}

function SelectProvince(data) {
    var self = this;
    self.id = ko.observable(data.id);
    self.province_name = ko.observable(data.province_name);

}

self.provinceOptions=ko.observableArray();
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

ko.applyBindings(new ClientViewModel());