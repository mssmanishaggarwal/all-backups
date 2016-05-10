$(document).ready(function() {
    $('#error_msg').hide();
    $('.spinner-loader').hide();    
});

function MapUser(data) {
    var self = this;
    self.hall_type_translation_id = ko.observable(data.hall_type_translation_id);
    self.hall_type_name = ko.observable(data.hall_type_name);
}

function LoadClient() {
	var baseUrl = $('#baseUrl').val();
    var self = this;
    self.availableSorting = ko.observableArray(['Hall Type Name']);

    self.hall_type_name = ko.observable();

    self.hall_type_translation_id = ko.observable();
    self.clientList = ko.observableArray();
    $.ajax({
        url: "halltype_list",
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
        window.location.href = 'halltype/' + data.id;
    };
    self.btnDelete = function(data) {
        bootbox.confirm("Would you confirm to delete this Hall Type?", function(result) {
        if (result == true) {
        $.ajax({
        url: "halltype_list/"+data.id,
        type: "DELETE",
        contentType: "application/json",
        accept: "application/json",
        dataType: "json",
        success: function(res) {

               $.ajax({
           url: "halltype_list",
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
        var hall_type_name = $('#hall_type_name').val();


        $.ajax('halltype_list?hall_type_name=' + hall_type_name + '&todo=search', {
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

        if (sorting != '') {
            $.ajax('halltype_list?sorting=' + sorting + '&todo=sort_asc', {
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
            $.ajax('halltype_list?sorting=' + sorting + '&todo=sort_desc', {
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
    /*self.up = function(e) {
   $.ajax('halltype_list?order_type=up&todo=order&primary_id='+e.id, {
                type: 'GET',
                accept: 'application/json',
                contentType: 'application/json',
                success: function(res) {

                    
                  $.ajax({
                  url: "halltype_list",
                  type: "GET",
                  contentType: "application/json",
                  accept: "application/json",
                  dataType: "json",
                  success: function(res) {

                  self.clientList(res);

                  }
                  });
                    $('#spinner-loader-date').fadeOut('slow');
                    $('#tbl-DAS').fadeIn('slow');
                }
            });
    
    
    };

    self.down = function(e) {
   $.ajax('halltype_list?order_type=down&todo=order&primary_id='+e.id, {
                type: 'GET',
                accept: 'application/json',
                contentType: 'application/json',
                success: function(res) {

                  $.ajax({
                  url: "halltype_list",
                  type: "GET",
                  contentType: "application/json",
                  accept: "application/json",
                  dataType: "json",
                  success: function(res) {

                  self.clientList(res);

                  }
                  });
                  $('#spinner-loader-date').fadeOut('slow');
                  $('#tbl-DAS').fadeIn('slow');
                    
                }
            });
    
    
    };*/
    
    self.setReset = function() {
    		 window.location.href = baseUrl+'/admin/halltype_list';
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