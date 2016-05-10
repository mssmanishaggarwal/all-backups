$(document).ready(function() {
    $('#error_msg').hide();
    $('.spinner-loader').hide();
});

function MapUser(data) {
    var self = this;    
    self.first_name = ko.observable(data.first_name);
    self.email = ko.observable(data.email);
    self.contact_number = ko.observable(data.contact_number);
    self.city = ko.observable(data.city);
    self.state = ko.observable(data.state);
    self.postcode = ko.observable(data.postcode);
    self.country = ko.observable(data.country);
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

self.userOptions = ko.observableArray();
self.userOptions = [{val: 'User',id: 'U'},
				  {val: 'Owner',id: 'O'}
			 ];

function LoadClient() {
	var baseUrl = $('#baseUrl').val();
    var self = this;
    self.availableSorting = ko.observableArray([
        { id: "first_name", name: "Name"},
        { id: "email", name: "Email"},
        { id: "user_type", name: "User Type"},
        { id: "province_name", name: "Province"}
    ]);
    self.first_name = ko.observable();
    self.email = ko.observable();
    self.contact_number = ko.observable();
    self.city = ko.observable();
    self.state = ko.observable();
    self.postcode = ko.observable();
    self.country = ko.observable();
   
    self.clientList = ko.observableArray();
    $.ajax({
        url: "user_list",
        type: "GET",
        contentType: "application/json",
        accept: "application/json",
        dataType: "json",
        success: function(res) {

            self.clientList(res);

        }
    });

    self.btnEdit = function(data) {
        //window.location.href = 'client/'+data.id;
        window.location.href = 'user/' + data.id;
    };
    self.btnDelete = function(data) {
        bootbox.confirm("Would you confirm to delete this User?", function(result) {
        if (result == true) {
        $.ajax({
        url: "user/"+data.location_id,
        type: "DELETE",
        contentType: "application/json",
        accept: "application/json",
        dataType: "json",
        success: function(res) {

               $.ajax({
           url: "location_list",
           type: "GET",
           contentType: "application/json",
           accept: "application/json",
           dataType: "json",
           success: function(res) {

               self.clientList(res);

           }
          });

        }
       });
       }
       });
    };
    


    self.searchClient = function() {
        $('#spinner-loader-search').show();
        var first_name = $('#first_name').val();
        var email = $('#email').val();
        var contact_number = $('#contact_number').val();
        var city = $('#city').val();
        var postcode = $('#postcode').val();
        var state = $('#state').val();
        var user_type = $('#user_type').val();
        var is_active = '';
        if($('#is_active').prop('checked'))
        	 is_active = 1;
        else
            is_active = 0;            	
       


        //$.ajax('user_list?first_name=' + first_name + '&email=' + email + '&contact_number=' + contact_number + '&todo=search', {
        $.ajax('user_list', {
            type: 'GET',
            data:{'first_name':first_name,
				'email':email,
				'contact_number':contact_number,
				'city':city,
				'postcode':postcode,
				'state':state,
				'user_type':user_type,
				'is_active':is_active,
				'todo':'search'
				},
            accept: 'application/json',
            contentType: 'application/json',
            success: function(res) {

                self.clientList(res);
                $('#spinner-loader-search').fadeOut('slow');
                $('#tbl-DAS').fadeIn('slow');
            }
        });
    };
    self.sortClientASC = function() {
        var sorting = $('#sorting').val();

        if (sorting != '') {
            $.ajax('user_list?sorting=' + sorting + '&todo=sort_asc', {
                type: 'GET',
                accept: 'application/json',
                contentType: 'application/json',
                success: function(res) {


                    self.clientList(res);
                    $('#spinner-loader-date').fadeOut('slow');
                    $('#tbl-DAS').fadeIn('slow');
                }
            });
        }

    };
    self.sortClientDESC = function() {
        var sorting = $('#sorting').val();

        if (sorting != '') {
            $.ajax('user_list?sorting=' + sorting + '&todo=sort_desc', {
                type: 'GET',
                accept: 'application/json',
                contentType: 'application/json',
                success: function(res) {

                    self.clientList(res);
                    $('#spinner-loader-date').fadeOut('slow');
                    $('#tbl-DAS').fadeIn('slow');
                }
            });
        }

    };
    
     self.setReset = function() {
    		 window.location.href = baseUrl+'/admin/user_list';
    	};

    // pagination
    self.pageNumber = ko.observable(0);
    self.numPerPage = ko.observable(20);
    self.lastPage = ko.observable();
    self.currentPageItem = ko.observable();
    self.totalPages = ko.computed(function() {
        var div = Math.floor(self.clientList().length / self.numPerPage());
        div += self.clientList().length % self.numPerPage() > 0 ? 1 : 0;
        self.lastPage(div);
        return div - 1;
    });

    self.paginatedData = ko.computed(function() {
        var first = self.pageNumber() * self.numPerPage();
        var sliceData = self.clientList.slice(first, first + self.numPerPage())
        self.currentPageItem(sliceData);
        return sliceData;
    });

    self.hasPrevious = ko.computed(function() {
        return self.pageNumber() !== 0;
    });

    self.hasNext = ko.computed(function() {
        return self.pageNumber() !== self.totalPages();
    });

    self.next = function() {
        if (self.pageNumber() < self.totalPages()) {
            self.pageNumber(self.pageNumber() + 1);
        }
    };

    self.previous = function() {
        if (self.pageNumber() != 0) {
            self.pageNumber(self.pageNumber() - 1);
        }
    };
}
ko.applyBindings(new LoadClient());