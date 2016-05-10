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

ko.bindingHandlers.datetext = {
    init: function (element, valueAccessor, allBindingsAccessor) {
        // Provide a custom text value
        var value = valueAccessor(), allBindings = allBindingsAccessor();
        var dateFormat = allBindingsAccessor.dateFormat || "dd/mm/yyyy";
        var strDate = window.ko.utils.unwrapObservable(value);
        if (strDate) {
            if (moment(strDate).year() > 1970) {
                var date = moment(strDate).format(dateFormat);
                $(element).text(date);
            }
            else {
                $(element).text("-");
            }
        }
    },
    update: function (element, valueAccessor, allBindingsAccessor) {
        // Provide a custom text value
        var value = valueAccessor(), allBindings = allBindingsAccessor();
        var dateFormat = allBindingsAccessor.dateFormat || "dd/mm/yyyy";
        var strDate = window.ko.utils.unwrapObservable(value);
        if (strDate) {
            if (moment(strDate).year() > 1970) {
                var date = moment(strDate).format(dateFormat);
                $(element).text(date);
            }
            else {
                $(element).text("-");
            }
        }
    }
};

function MapUser(data){	
	var baseUrl = $('#baseUrl').val();
    var self = this;
    self.id = ko.observable(data.id);   
    self.advertisement_title = ko.observable(data.advertisement_title);
     
}

function SelectPosition(data) {
    var self = this;
    self.id = ko.observable(data.id);
    self.position_name = ko.observable(data.position_name);

}

self.positionOptions=ko.observableArray();
var baseUrl = $('#baseUrl').val();
 $.ajax({
  url: baseUrl+"/admin/advertisement/getposition",
  type: "GET",
  contentType: "application/json",
  accept: "application/json",
  success: function(result) {
     var map = $.map(result, function(item) {
        return new SelectPosition(item);
    });     
     self.positionOptions(map);
 }
});


function ClientViewModel(data){
    var baseUrl = $('#baseUrl').val();

    var self = this;
    self.advertisementList = ko.observableArray();
    self.advertisement_title_1 = ko.observable();
    self.advertisement_title_2 = ko.observable();
    self.advertisement_link = ko.observable();
    self.position_id = ko.observable();
    self.start_date = ko.observable();
    self.end_date = ko.observable();
      
    var pathname = window.location.pathname,
        id = pathname.substring(pathname.lastIndexOf('/') + 1);

    var ajax_url ='';
    var ajax_update_url ='';
    if(id != 'advertisement'){
        ajax_url =baseUrl+"/admin/advertisement/"+id;
        ajax_update_url =baseUrl+"/admin/advertisement/update/"+id;
    }
    else{
        ajax_url =baseUrl+"/advertisement";
    }
    if(id=='advertisement'){

        self.advertisementList = ko.observableArray();
        setTimeout(function(){ $('.spinner-loader_edit').hide(); $('#main').fadeIn('slow'); }, 500);

    }
    if(id != 'advertisement' && id!='') {
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
            self.advertisementList(res);
            
            setTimeout(function(){ $('.spinner-loader_edit').hide(); $('#main').fadeIn('slow'); }, 500);

            }
        });
    }


    self.save = function() {
        var validated = $("#master-file-form").data("bootstrapValidator");
        validated.isValid(), validated.validate();
        if(validated.isValid()) {
        	
        	var advertisement_title_1 = $('#advertisement_title_1').val();
            var advertisement_title_2 = $('#advertisement_title_2').val(); 
            var advertisement_link = $('#advertisement_link').val(); 
            var position_id = $('#position_id').val(); 
            var start_date = $('#start_date').val(); 
            var end_date = $('#end_date').val();
            var is_active = '';           
            if($('#is_active').prop('checked'))
            	 is_active = 1;            	
            else
            	is_active = 0;
			
			var formData = new FormData($('form#master-file-form')[0]);
			//var formData = $('form#master-file-form').serialize();
			//console.log(formData);
			//return false;
			
            $('.spinner-loader').show();
            $('.add_contact').attr('disabled', '');
            if (id != 'advertisement' && id != '') {
				
                $.ajax(ajax_update_url, {
                    data: JSON.stringify({
                        advertisement_title_1: advertisement_title_1,
                        advertisement_title_2: advertisement_title_2,
                        advertisement_link: advertisement_link,
                        position_id: position_id,
                        start_date: start_date,
                        end_date: end_date,
                        is_active: is_active
                    }),
                    type: "PUT", contentType: 'application/json',
                    success: function (res) {

                        $('.spinner-loader').hide();
                        $('.save_msg').show().fadeOut(2000);
                        $('.add_contact').removeAttr('disabled');
                        setTimeout(function(){ window.location.href = baseUrl+'/admin/advertisement_list'; }, 2000);  
                    }, errors: function (res) {
                        console.log('Error: ' + res);
                    }
                });
            }
            else{            	
                $.ajax('advertisement/store', {
                    /*data: JSON.stringify({
                        advertisement_title_1: advertisement_title_1,
                        advertisement_title_2: advertisement_title_2,
                        advertisement_link: advertisement_link,
                        position_id: position_id,
                        start_date: start_date,
                        end_date: end_date,
                        is_active: is_active
                    }),*/
                    data: formData,
                    type: "POST",
                    //contentType: 'application/json',
                    contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,  
                    success: function (res) {
                        $('.spinner-loader').hide();
                        $('.save_msg').show().fadeOut(2000);
                        $('.add_contact').removeAttr('disabled'); 
                           
                        setTimeout(function(){ window.location.href = baseUrl+'/admin/advertisement_list'; }, 2000);                    
                    }, errors: function (res) {
                        console.log('Error: ' + res);
                    }
                });
            }
        }
    };
    
    self.cancel = function() {
    		 window.location.href = baseUrl+'/admin/advertisement_list';
    	};

}



ko.applyBindings(new ClientViewModel());