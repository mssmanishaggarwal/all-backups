$(document).ready(function() {
    $('#error_msg').hide();
    $('#main').hide();
    $('.spinner-loader').hide();
    $('.spinner-loader_edit').hide();
    $('.save_msg').hide();
    $('#client-table').hide();
    var lower_range = $('#lower_range').val();
    $('#master-file-form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            upper_range: {
                message: 'The Upper range is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Upper range is required'
                    },                    
                    regexp: {
                        regexp: /^\d*(?:\.\d{1,2})?$/,
                        message: 'The Upper range only in number'
                    },
                    greaterThan: {
                        value: lower_range,
                        message: 'Upper range should be greater than lower range'
                    }
                }
            }
        }
    });


});

function MapPricerange(data){	
	var baseUrl = $('#baseUrl').val();
    var self = this;
    self.id = ko.observable(data.id);   
    self.price_range_title = ko.observable(data.price_range_title);   
    self.lower_range = ko.observable(data.lower_range);   
    self.upper_range = ko.observable(data.upper_range);   
    self.currency_id = ko.observable(data.currency_id);
    self.language_id = ko.observable(data.language_id);   
}

/*function SelectCurrency(data) {
    var self = this;
    self.currency_id = ko.observable(data.id);
    self.currency_name = ko.observable(data.currency_name);
    self.currency_code = ko.observable(data.currency_code);
}

var baseUrl = $('#baseUrl').val();
 self.currencyOptions= ko.observableArray();
 $.ajax({
  url: baseUrl+"/admin/pricerange/selectcurrency",
  type: "GET",
  contentType: "application/json",
  accept: "application/json",
  success: function(result) {
     var map = $.map(result, function(item) {
        return new SelectCurrency(item);
    });
     self.currencyOptions(map);
 }
});*/

function ClientViewModel(data){
    var baseUrl = $('#baseUrl').val();

    var self = this;
    self.priceRangelist = ko.observableArray();
    self.price_range_title_1 = ko.observable();
    self.price_range_title_2 = ko.observable();
    self.lower_range = ko.observable();
    self.upper_range = ko.observable();
    self.currency_id = ko.observable();
      
    var pathname = window.location.pathname,
        id = pathname.substring(pathname.lastIndexOf('/') + 1);

    var ajax_url ='';
    var ajax_update_url ='';
    if(id != 'pricerange'){
        ajax_url =baseUrl+"/admin/pricerange/"+id;
        ajax_update_url =baseUrl+"/admin/pricerange/update/"+id;
    }
    else{
        ajax_url =baseUrl+"/pricerange";
    }
    if(id=='pricerange'){

        self.priceRangelist = ko.observableArray();
        setTimeout(function(){ $('.spinner-loader_edit').hide(); $('#main').fadeIn('slow'); }, 500);

    }
    if(id != 'pricerange' && id!='') {
        $('.spinner-loader_edit').show();
        $('#main').hide();
        $.ajax({
            url: ajax_url,
            type: "GET",
            contentType: "application/json",
            accept: "application/json",
            dataType: "json",
            success: function (res) {            	
               /* var map = $.map(res, function (item) {
                    return new MapPricerange(item);
                }); */              
            self.priceRangelist(res);
            
            setTimeout(function(){ $('.spinner-loader_edit').hide(); $('#main').fadeIn('slow'); }, 500);

            }
        });
    }


    self.save = function() {
        var validated = $("#master-file-form").data("bootstrapValidator");
        validated.isValid(), validated.validate();
        if(validated.isValid()) {
        	
        	var price_range_title_1 = $('#price_range_title_1').val();
            var price_range_title_2 = $('#price_range_title_2').val(); 
            var currency_id = $('#currency_id').val(); 
            var lower_range = $('#lower_range').val(); 
            var upper_range = $('#upper_range').val();
            
			
            $('.spinner-loader').show();
            $('.add_contact').attr('disabled', '');
            if (id != 'pricerange' && id != '') {
                             

                $.ajax(ajax_update_url, {
                    data: JSON.stringify({
                        price_range_title_1: price_range_title_1,
                        price_range_title_2: price_range_title_2,
                        currency_id: currency_id,
                        lower_range: lower_range,
                        upper_range: upper_range                        
                    }),
                    type: "PUT", contentType: 'application/json',
                    success: function (res) {

                        $('.spinner-loader').hide();
                        $('.save_msg').show().fadeOut(2000);
                        $('.add_contact').removeAttr('disabled');
                        setTimeout(function(){ window.location.href = baseUrl+'/admin/pricerange_list'; }, 2000);  
                    }, errors: function (res) {
                        console.log('Error: ' + res);
                    }
                });
            }
            else{            	
                $.ajax('pricerange/store', {
                    data: JSON.stringify({
                        price_range_title_1: price_range_title_1,
                        price_range_title_2: price_range_title_2,
                        currency_id: currency_id,
                        lower_range: lower_range,
                        upper_range: upper_range                        
                    }),
                    type: "POST", contentType: 'application/json',
                    success: function (res) {
                        $('.spinner-loader').hide();
                        $('.save_msg').show().fadeOut(2000);
                        $('.add_contact').removeAttr('disabled'); 
                           
                        setTimeout(function(){ window.location.href = baseUrl+'/admin/pricerange_list'; }, 2000);                    
                    }, errors: function (res) {
                        console.log('Error: ' + res);
                    }
                });
            }
        }
    };
    
    self.cancel = function() {
    		 window.location.href = baseUrl+'/admin/pricerange_list';
    	};

}

ko.applyBindings(new ClientViewModel());