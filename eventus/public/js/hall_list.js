$(document).ready(function() {
    $('#error_msg').hide();
    $('.spinner-loader').hide();
});

function Maphall(data) {
    var self = this;    
    self.hall_name = ko.observable(data.hall_name);
    self.contact_name = ko.observable(data.contact_name);
       // self.first_name = ko.observable(data.first_name);
       // self.last_name = ko.observable(data.last_name);
    self.contact_email = ko.observable(data.contact_email);
    self.hall_city = ko.observable(data.hall_city);
    self.hall_state = ko.observable(data.hall_state);
    self.hall_postcode = ko.observable(data.hall_postcode);
    self.hall_country = ko.observable(data.hall_country);
}
function SelectLocation(data) {
    var self = this;
    self.location_id = ko.observable(data.location_id);
    self.location_name = ko.observable(data.location_name);

} 
 var baseUrl = $('#baseUrl').val();
 self.myOptions= ko.observableArray();
 $.ajax({
  url: baseUrl+"/admin/hall/selectlocation",
  type: "GET",
  contentType: "application/json",
  accept: "application/json",
  success: function(result) {
     var map = $.map(result, function(item) {
        return new SelectLocation(item);
    });
     self.myOptions(map);
 }
});

function LoadClient() {

    var self = this;
    /*self.availableSorting = ko.observableArray(['Hall Name','Contact Name','City']);*/

    self.availableSorting =ko.observableArray([
        { id: "hall_name", name: "Hall Name"},
        { id: "contact_name", name: "Contact Name"},
        { id: "hall_city", name: "City"}
    ]);
    self.location_id = ko.observable();
    self.hall_name = ko.observable();
    self.contact_name = ko.observable();
    self.contact_email = ko.observable();
    self.hall_city = ko.observable();
    self.hall_state = ko.observable();
    self.hall_postcode = ko.observable();
    self.hall_country = ko.observable();
   
    self.clientList = ko.observableArray();
    $.ajax({
        url: "hall_list",
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
       // console.log(data);
          window.location.href = 'hall/' + data.hall_id;
    };
    self.btnEditimag = function(data) {
      
          window.location.href = 'hall/uploadimage/' + data.hall_id;
    };
    self.btnEditaddon = function(data) {
      
          window.location.href = 'hall/addon/' + data.hall_id;
    };
    self.btnEditaccommodation = function(data) {
      
          window.location.href = 'hall/accommodation/' + data.hall_id;
    };
    self.btnEditsubscription = function(data) {
      
          window.location.href = 'hall/subscription/' + data.hall_id;
    };
    self.btnDelete = function(data) {
        var baseUrl = $('#baseUrl').val();
        bootbox.confirm('Are you sure want to delete this hall?', function(result) {
        if (result == true) { //alert(baseUrl);
           // console.log(data);
        $.ajax({
        url: baseUrl+"/admin/hall/"+data.hall_id,
        type: "DELETE",
        contentType: "application/json",
        accept: "application/json",
        dataType: "json",
        success: function(res) {

               $.ajax({
           url: "hall_list",
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
    
    self.setRest= function(){
        window.location.href="hall_list";

    }

    self.searchClient = function() {
        $('#spinner-loader-search').show();
        var hall_name = $('#hall_name').val();
        var contact_name = $('#contact_name').val();
        var hall_city = $('#hall_city').val();
        var contact_email = $('#contact_email').val();
        var contact_mobile=$('#contact_mobile').val();
        var rental_amount=$('#rental_amount').val();
        var location_id=$('#location_id').val();

        $.ajax({
           url: "hall_list",
           data:{
            hall_name:hall_name,
            contact_name:contact_name,
            hall_city:hall_city,
            contact_email:contact_email,
            contact_mobile:contact_mobile,
            rental_amount:rental_amount,
            location_id:location_id,
            todo:'search',
           },
            type: 'GET',
            accept: 'application/json',
            contentType: 'application/json',
            dataType: "json",
            success: function(res) {
                console.log(res);
               self.clientList(res);
               $('#spinner-loader-search').fadeOut('slow');
                $('#tbl-DAS').fadeIn('slow');
            }
        });
    };
    self.sortClientASC = function() {
        var sorting = $('#sorting').val();

        if (sorting != '') {
            $.ajax('hall_list?sorting=' + sorting + '&todo=sort_asc', {
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
            $.ajax('hall_list?sorting=' + sorting + '&todo=sort_desc', {
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