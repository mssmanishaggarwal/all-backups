$(document).ready(function() {
    $('#error_msg').hide();
    $('.spinner-loader').hide();
    
    $('#search_start_date').datepicker({
		format: "dd/mm/yyyy"							
									
									
	});	
	$('#search_end_date').datepicker({
		format: "dd/mm/yyyy"							
								
	});
});

function MapUser(data) {
    var self = this;
    self.advertisement_translation_id = ko.observable(data.advertisement_translation_id);
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
    setTimeout('100');
     self.positionOptions(map);
 }
});



function LoadClient() {
	var baseUrl = $('#baseUrl').val();
    var self = this;
    self.availableSorting = ko.observableArray([
        { id: "advertisement_title", name: "Advertisement Title"},
        { id: "start_date", name: "Publish Date"},
        { id: "end_date", name: "Expiry Date"},
        { id: "position_id", name: "Position"}
    ]);

    self.advertisement_title = ko.observable();
    self.advertisement_translation_id = ko.observable();
    self.clientList = ko.observableArray();
    $.ajax({
        url: "advertisement_list",
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
        window.location.href = 'advertisement/' + data.id;
    };
    self.btnDelete = function(data) {
        bootbox.confirm("Would you confirm to delete this Advertisement?", function(result) {
        if (result == true) {
        $.ajax({
        url: "advertisement/"+data.id,
        type: "DELETE",
        contentType: "application/json",
        accept: "application/json",
        dataType: "json",
        success: function(res) {

               $.ajax({
           url: "advertisement_list",
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
        var advertisement_title = $('#advertisement_title').val();
        var position_id = $('#position_id').val();
        var search_with_date = $('#search_with_date').val();
        var search_start_date = $('#search_start_date').val();
        var search_end_date = $('#search_end_date').val();

        //$.ajax('advertisement_list?advertisement_title=' + advertisement_title + '&todo=search', {
        $.ajax('advertisement_list', {
            type: 'GET',
            data:{'advertisement_title':advertisement_title,
				'position_id':position_id,
				'search_with_date':search_with_date,
				'search_start_date':search_start_date,
				'search_end_date':search_end_date,
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
            $.ajax('advertisement_list?sorting=' + sorting + '&todo=sort_asc', {
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
            $.ajax('advertisement_list?sorting=' + sorting + '&todo=sort_desc', {
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
    		 window.location.href = baseUrl+'/admin/advertisement_list';
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
