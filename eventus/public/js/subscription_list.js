$(document).ready(function() {
    $('#error_msg').hide();
    $('.spinner-loader').hide();
});

function MapUser(data) {
    var self = this;
    self.subscription_translation_id = ko.observable(data.subscription_translation_id);
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

function LoadClient() {
	var baseUrl = $('#baseUrl').val();
    var self = this;
    self.availableSorting = ko.observableArray([
        { id: "subscription_name", name: "Subscription Name"},
        { id: "subscription_month", name: "Subscription Month"},
        { id: "subscription_price", name: "Subscription Price"}
    ]);

    self.subscription_name = ko.observable();

    self.subscription_translation_id = ko.observable();
    self.clientList = ko.observableArray();
    $.ajax({
        url: "subscription_list",
        type: "GET",
        contentType: "application/json",
        accept: "application/json",
        dataType: "json",
        success: function(res) {

            self.clientList(res);

        }
    });

    self.btnEdit = function(data) {
        window.location.href = 'subscription/' + data.id;
    };
    self.btnDelete = function(data) {
        bootbox.confirm("Are you sure want to delete this Subscription?", function(result) {
        if (result == true) {
        $.ajax({
        url: "subscription_list/"+data.id,
        type: "DELETE",
        contentType: "application/json",
        accept: "application/json",
        dataType: "json",
        success: function(res) {

               $.ajax({
           url: "subscription_list",
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
        var subscription_name = $('#subscription_name').val();
        var subscription_month = $('#subscription_month').val();
        var subscription_price = $('#subscription_price').val();


        //$.ajax('subscription_list?subscription_name=' + subscription_name +'&subscription_month='+ subscription_month +'&subscription_price=' + subscription_price + '&todo=search', {
        $.ajax('subscription_list', {
            type: 'GET',
             data:{'subscription_name':subscription_name,
				'subscription_month':subscription_month,
				'subscription_price':subscription_price,				
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
            $.ajax('subscription_list?sorting=' + sorting + '&todo=sort_asc', {
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
            $.ajax('subscription_list?sorting=' + sorting + '&todo=sort_desc', {
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
    		 window.location.href = baseUrl+'/admin/subscription_list';
    	};

    // pagination
    self.pageNumber = ko.observable(0);
    self.numPerPage = ko.observable(5);
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