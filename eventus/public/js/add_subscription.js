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

function MapSubscription(data){	
	var baseUrl = $('#baseUrl').val();
    var self = this;
    self.id = ko.observable(data.id);   
    self.subscription_name = ko.observable(data.subscription_name);
     
}

self.subscriptionMonth	= ko.observableArray();
self.subscriptionMonth = [{val: 3,id: 3},
						  {val: 6,id: 6},
						  {val: 12,id: 12},
						  {val: 18,id: 18},
						  {val: 24,id: 24},
						  {val: 30,id: 30},
						  {val: 36,id: 36},
						  {val: 42,id: 42},
						  {val: 48,id: 48},
						  {val: 54,id: 54},
						  {val: 60,id: 60}
     					 ];

function ClientViewModel(data){
    var baseUrl = $('#baseUrl').val();

    var self = this;
    self.subscriptionList = ko.observableArray();    
    self.subscription_name_1 = ko.observable();
    self.subscription_name_2 = ko.observable();
    self.subscription_price = ko.observable();
      
    var pathname = window.location.pathname,
        id = pathname.substring(pathname.lastIndexOf('/') + 1);

    var ajax_url ='';
    var ajax_update_url ='';
    if(id != 'subscription'){
        ajax_url =baseUrl+"/admin/subscription/"+id;
        ajax_update_url =baseUrl+"/admin/subscription/update/"+id;
    }
    else{
        ajax_url =baseUrl+"/subscription";
    }
    if(id=='subscription'){

        self.subscriptionList = ko.observableArray();
        setTimeout(function(){ $('.spinner-loader_edit').hide(); $('#main').fadeIn('slow'); }, 500);

    }
    if(id != 'subscription' && id!='') {
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
            self.subscriptionList(res);
            
            setTimeout(function(){ $('.spinner-loader_edit').hide(); $('#main').fadeIn('slow'); }, 500);

            }
        });
    }


    self.save = function() {
        var validated = $("#master-file-form").data("bootstrapValidator");
        validated.isValid(), validated.validate();
        if(validated.isValid()) {
        	
        	var subscription_name_1 = $('#subscription_name_1').val();
            var subscription_name_2 = $('#subscription_name_2').val(); 
            var subscription_month = $('#subscription_month').val();
            var subscription_price = $('#subscription_price').val();
            var is_active = '';           
            if($('#is_active').prop('checked'))
            	 is_active = 1;            	
            else
            	is_active = 0;
			
            $('.spinner-loader').show();
            $('.add_contact').attr('disabled', '');
            if (id != 'subscription' && id != '') {
                             

                $.ajax(ajax_update_url, {
                    data: JSON.stringify({
                        subscription_name_1: subscription_name_1,
                        subscription_name_2: subscription_name_2,
                        subscription_month: subscription_month,
                        subscription_price: subscription_price,
                        is_active: is_active
                    }),
                    type: "PUT", contentType: 'application/json',
                    success: function (res) {

                        $('.spinner-loader').hide();
                        $('.save_msg').show().fadeOut(2000);
                        $('.add_contact').removeAttr('disabled');
                        setTimeout(function(){ window.location.href = baseUrl+'/admin/subscription_list'; }, 2000);  
                    }, errors: function (res) {
                        console.log('Error: ' + res);
                    }
                });
            }
            else{            	
                $.ajax('subscription/store', {
                    data: JSON.stringify({
                        subscription_name_1: subscription_name_1,
                        subscription_name_2: subscription_name_2,
                        subscription_month: subscription_month,
                        subscription_price: subscription_price,
                        is_active: is_active
                    }),
                    type: "POST", contentType: 'application/json',
                    success: function (res) {
                        $('.spinner-loader').hide();
                        $('.save_msg').show().fadeOut(2000);
                        $('.add_contact').removeAttr('disabled'); 
                           
                        //setTimeout(function(){ window.location.href = baseUrl+'/admin/subscription_list'; }, 2000);                    
                    }, errors: function (res) {
                        console.log('Error: ' + res);
                    }
                });
            }
        }
    };
    
    self.cancel = function() {
    		 window.location.href = baseUrl+'/admin/subscription_list';
    	};

}

ko.applyBindings(new ClientViewModel());