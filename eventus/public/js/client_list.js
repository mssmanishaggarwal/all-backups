$(document).ready(function() {
    $('#error_msg').hide();
    $('.spinner-loader').hide();
});

function MapUser(data){
    var self = this;
    self.id = ko.observable(data.id);
    self.name = ko.observable(data.name);
}

function LoadClient(){

    var self = this;
    self.availableSorting = ko.observableArray(['name', 'email']);

    self.name = ko.observable();
    self.email = ko.observable();
    self.phone = ko.observable();
    self.id = ko.observable();
    self.clientList = ko.observableArray();
 $.ajax({
        url: "client-list",
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
        window.location.href = 'client/'+data.id;
    };
	
	
	self.searchClient = function(){
	$('#spinner-loader-search').show();
        var name  = $('#name').val(),
            email = $('#email').val(),
			phone = $('#phone').val();			

        $.ajax('client-list?name='+name+'&email='+email+'&phone='+phone+'&todo=search',
            {
                type: 'GET', accept: 'application/json', contentType: 'application/json',
                success: function(data){                   
                    self.clientList(data);
                    $('#spinner-loader-search').fadeOut('slow');
                    $('#tbl-DAS').fadeIn('slow');
                }
            });
    };
    self.sortClientASC = function(){
        var sorting = $('#sorting').val();

        if(sorting!=''){
            $.ajax('client-list?sorting='+sorting+'&todo=sort_asc',
                {
                    type: 'GET', accept: 'application/json', contentType: 'application/json',
                    success: function(data){

                        self.clientList(data);
                        $('#spinner-loader-date').fadeOut('slow');
                        $('#tbl-DAS').fadeIn('slow');
                    }
                });
        }

    };
    self.sortClientDESC = function(){
        var sorting = $('#sorting').val();

        if(sorting!=''){
            $.ajax('client-list?sorting='+sorting+'&todo=sort_desc',
                {
                    type: 'GET', accept: 'application/json', contentType: 'application/json',
                    success: function(data){

                        self.clientList(data);
                        $('#spinner-loader-date').fadeOut('slow');
                        $('#tbl-DAS').fadeIn('slow');
                    }
                });
        }

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