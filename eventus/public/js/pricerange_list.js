$(document).ready(function() {
    $('#error_msg').hide();
    $('.spinner-loader').hide();
});

function MapUser(data) {
    var self = this;
    self.price_range_translation_id = ko.observable(data.price_range_translation_id);
    self.price_range_title = ko.observable(data.price_range_title);
}

function LoadClient() {
	var baseUrl = $('#baseUrl').val();
    var self = this;
    self.availableSorting = ko.observableArray(['Title','Lower Range','Upper Range']);

    self.price_range_title = ko.observable();
    self.lower_range = ko.observable();
    self.upper_range = ko.observable();
    self.price_range_translation_id = ko.observable();
    self.clientList = ko.observableArray();
    $.ajax({
        url: baseUrl+"/admin/pricerange_list?id=1",
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
        window.location.href = 'pricerange/' + data.id;
    };
    
    self.addRange =function(data){
		var currency_id = $('#currency_id').val();
		window.location.href = 'pricerange?currency_id='+currency_id;
	};
    self.btnDelete = function(data) {
        bootbox.confirm("Would you confirm to delete this Price Range?", function(result) {
        if (result == true) {
        $.ajax({
        url: "pricerange_list/"+data.id,
        type: "DELETE",
        contentType: "application/json",
        accept: "application/json",
        dataType: "json",
        success: function(res) {

               $.ajax({
           url: "pricerange_list",
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
        var price_range_title = $('#price_range_title').val();
		var currency_id = $('#currency_id').val();
        $.ajax('pricerange_list?price_range_title=' + price_range_title +'&id='+currency_id+ '&todo=search', {
            type: 'GET',
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
		var currency_id = $('#currency_id').val();
        if (sorting != '') {
            $.ajax('pricerange_list?sorting=' + sorting +'&id='+currency_id+ '&todo=sort_asc', {
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
		var currency_id = $('#currency_id').val();
        if (sorting != '') {
            $.ajax('pricerange_list?sorting=' + sorting +'&id='+currency_id+ '&todo=sort_desc', {
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
    
    self.showAnglo =  function() {
       
            $.ajax(baseUrl+"/admin/pricerange_list?id=1", {
                type: 'GET',
                accept: 'application/json',
                contentType: 'application/json',
                success: function(res) {

                    self.clientList(res);
                    $('#spinner-loader-date').fadeOut('slow');
                    $('#tbl-DAS').fadeIn('slow');
                    $('#angloid').addClass('active');
                    $('#euroid').removeClass('active');
                    $('#add_range').html('Add AOA Price Range');
                    $('#currency_id').val(1);
                }
            });
        

    };
    
    self.showEuro =  function() {
       
            $.ajax(baseUrl+"/admin/pricerange_list?id=2", {
                type: 'GET',
                accept: 'application/json',
                contentType: 'application/json',
                success: function(res) {

                    self.clientList(res);
                    $('#spinner-loader-date').fadeOut('slow');
                    $('#tbl-DAS').fadeIn('slow');
                    $('#euroid').addClass('active');
                    $('#angloid').removeClass('active');
                    $('#add_range').html('Add Euro Price Range');
                    $('#currency_id').val(2);
                    
                    
                }
            });
       

    };   
    
    self.setReset = function() {
    		 window.location.href = baseUrl+'/admin/pricerange_list';
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