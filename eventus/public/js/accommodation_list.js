$(document).ready(function() {
    $('#error_msg').hide();
    $('.spinner-loader').hide();
	$('#lastInsert').show(0).delay(5000).hide(0);	
});

function MapUser(data) {
    var self = this;
    self.accommodation_translation_id = ko.observable(data.accommodation_translation_id);
    self.accommodation_name = ko.observable(data.accommodation_name);
}

function LoadClient() {
	var baseUrl = $('#baseUrl').val();
    var self = this;
    self.availableSorting = ko.observableArray([{id: "accommodation_name", name: "Accommodation Name"}]);
	self.current_page 	= ko.observable();
    self.accommodation_name = ko.observable();
	self.lastInsertID 	= ko.observable();
	self.lastUpdateID 	= ko.observable();
	self.keyWord 		= ko.observable();
	self.orderCol 		= ko.observable();
	self.currentPage 	= ko.observable();
    self.accommodation_translation_id = ko.observable();
    self.clientList = ko.observableArray();
    
    $.ajax({
        url: "accommodation_list",
        type: "GET",
        contentType: "application/json",
        accept: "application/json",
        dataType: "json",
        success: function(res) {
            self.clientList(res['data']);			
			self.pageNumber(res['current_page']);
			self.current_page(res['current_page']);
			self.keyword(res['keyword']);
			self.ordercol(res['ordercol']);
			self.lastInsertId(res['last_insertid']);
			self.lastUpdateId(res['last_updateid']);
			
        }
    });

    self.btnEdit = function(data) {
    	
    	var searchData = $('#searchForm').serialize();
    	if(searchData != '')
    	{
			$.ajax({
					url: "accommodation/"+data.id,
			        type: "GET",
			        data: searchData,
			        contentType: "application/json",
			        accept: "application/json",
			        dataType: "json",
			        success: function(res) {
							 self.clientList(res['data']);			
							 self.pageNumber(res['current_page']);
							 self.current_page(res['current_page']);
							 self.keyword(res['keyword']);
							 self.ordercol(res['ordercol']);
			        	}
				
				});
		}
    	
    	
        //window.location.href = 'client/'+data.id;
        window.location.href = 'accommodation/' + data.id;
    };
    self.btnDelete = function(data) {
        bootbox.confirm("Are you sure want to delete this accommodation?", function(result) {
        if (result == true) {
        $.ajax({
        url: "accommodation/"+data.id,
        type: "DELETE",
        contentType: "application/json",
        accept: "application/json",
        dataType: "json",
        success: function(res) {

               $.ajax({
           url: "accommodation_list",
           type: "GET",
           contentType: "application/json",
           accept: "application/json",
           dataType: "json",
           success: function(res) {

                self.clientList(res['data']);			
				self.pageNumber(res['current_page']);

           }
          });

        }
       });
       }
       });
    };
    


    self.searchClient = function() {
        $('#spinner-loader-search').show();
        var accommodation_name = $('#accommodation_name').val();


        $.ajax('accommodation_list?accommodation_name=' + accommodation_name + '&todo=search', {
            type: 'GET',
            accept: 'application/json',
            contentType: 'application/json',
            success: function(res) {

                self.clientList(res['data']);
				self.pageNumber(res['current_page']);			
                $('#spinner-loader-search').fadeOut('slow');
                $('#tbl-DAS').fadeIn('slow');
				$('.order-updown').hide();
				$('.order-blank').show();				
            }
        });
    };
    self.sortClientASC = function() {
        var sorting = $('#sorting').val(); 
	    //  var sorting = param1;

        if (sorting != '') {
            $.ajax('accommodation_list?sorting=' + sorting + '&todo=sort_asc', {
                type: 'GET',
                accept: 'application/json',
                contentType: 'application/json',
                success: function(res) {
                    self.clientList(res['data']);	
					self.pageNumber(res['current_page']);			
                    $('#spinner-loader-date').fadeOut('slow');
                    $('#tbl-DAS').fadeIn('slow');
					$('.order-updown').hide();
					$('.order-blank').show();
                }
            });
        }

    };
    self.sortClientDESC = function() {
        var sorting = $('#sorting').val();

        if (sorting != '') {
            $.ajax('accommodation_list?sorting=' + sorting + '&todo=sort_desc', {
                type: 'GET',
                accept: 'application/json',
                contentType: 'application/json',
                success: function(res) {
					self.clientList(res['data']);
					self.pageNumber(res['current_page']);
					$('#spinner-loader-date').fadeOut('slow');
                    $('#tbl-DAS').fadeIn('slow');
					$('.order-updown').hide();
					$('.order-blank').show();					
						
                }
            });
        }

    };
    /*Ordering===============*/
      self.up = function(e) {
   $.ajax('accommodation_list?order_type=up&todo=order&primary_id='+e.id, {
                type: 'GET',
                accept: 'application/json',
                contentType: 'application/json',
                success: function(res) {                    
                  $.ajax({
                  url: "accommodation_list",
                  type: "GET",
                  contentType: "application/json",
                  accept: "application/json",
                  dataType: "json",
                  success: function(res) {
                  	self.clientList(res['data']);
					self.pageNumber(res['current_page']);
                  }
                  });
                    $('#spinner-loader-date').fadeOut('slow');
                    $('#tbl-DAS').fadeIn('slow');
                }
            });
    
    
    };

    self.down = function(e) {
   			$.ajax('accommodation_list?order_type=down&todo=order&primary_id='+e.id, {
                type: 'GET',
                accept: 'application/json',
                contentType: 'application/json',
                success: function(res) {

                  $.ajax({
                  url: "accommodation_list",
                  type: "GET",
                  contentType: "application/json",
                  accept: "application/json",
                  dataType: "json",
                  success: function(res) {
                  	self.clientList(res['data']);
					self.pageNumber(res['current_page']);
                  }
                  });
                  $('#spinner-loader-date').fadeOut('slow');
                  $('#tbl-DAS').fadeIn('slow');
                    
                }
            });
    
    
    };
    
    self.setReset = function() {
    		 window.location.href = baseUrl+'/admin/accommodation_list';
    	};

    // pagination
	self.lastInsertId 	= ko.observable();
	self.lastUpdateId 	= ko.observable();
	self.keyword 		= ko.observable();
	self.ordercol 		= ko.observable();
	self.currentpage 	= ko.observable();
	
    self.pageNumber 	= ko.observable(0);	
	self.pageIndex 		= ko.observable(0);
    self.numPerPage 	= ko.observable(3);
    self.lastPage 		= ko.observable();
    self.currentPageItem= ko.observable();
    self.totalPages 	= ko.computed(function() {
        var div = Math.floor(self.clientList().length / self.numPerPage());
        div += self.clientList().length % self.numPerPage() > 0 ? 1 : 0;
        self.lastPage(div);
        return div - 1;
    });
	
	self.maxPageIndex = ko.computed(function () {
        return Math.ceil(self.clientList().length / self.numPerPage())-1;
    });
	
	
    self.paginatedData = ko.computed(function() {
        var first = self.pageNumber() * self.numPerPage();
        var sliceData = self.clientList.slice(first, first + self.numPerPage())
        self.currentPageItem(sliceData);
        return sliceData;
    });
	
	self.allPages = ko.computed(function () {	 
        var pagesArr=[];
        for (i = 0; i <= self.maxPageIndex() ; i++) {
            pagesArr.push({ pageNumber: (i + 1) });
			  
        }		
        return pagesArr;		
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
	
	
	self.moveToPage = function (index) {
        self.pageNumber(index);
		 $.ajax({
              url: "accommodation_list?todo=savesession&current_page="+index,
              type: "GET",
              contentType: "application/json",
              accept: "application/json",
              dataType: "json",
			  success: function(res) {
					self.clientList(res['data']);	
					self.keyword(res['keyword']);
					self.currentpage(res['current_page']);						
                  }
          });
     };
	 
	self.lastInsertID = ko.computed(function() {
				return self.lastInsertId();
			});
	self.lastUpdateID = ko.computed(function() {
				return self.lastUpdateId();
			});		
	self.keyWord = ko.computed(function() {
				return self.keyword();
			});
	self.orderCol = ko.computed(function() {
				return self.ordercol();
			});	
	self.currentPage = ko.computed(function() {
				return self.currentpage();
			});
}
ko.applyBindings(new LoadClient());