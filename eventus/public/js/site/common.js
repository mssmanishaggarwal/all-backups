function getLocation(){
	 $.ajax({
	  url: baseUrl+"/getLocation",
	  type: "GET",
	  contentType: "application/json",
	  accept: "application/json",
	  success: function(result) {
	     for(var key in result){ 
	     	$('#reg_city,#search_location').append('<option value="'+result[key].location_id+'">'+result[key].location_name+'</option>');
	     }
	 }
	});/*.done(function () { 
        $('#reg_city').niceSelect(); 
    });*/
}

function getProvince(){
	 $.ajax({
	  url: baseUrl+"/getProvince",
	  type: "GET",
	  contentType: "application/json",
	  accept: "application/json",
	  success: function(result) { 
	     for(var key in result){ 
	     	$('#province').append('<option value="'+result[key].id+'">'+result[key].province_name+'</option>');
	     }
	 } 
	});/*.done(function () { 
        $('#province').niceSelect();  
    });*/  
}

function getLocationAuto(){
	  $( "#reg_city" ).autocomplete({
      source: baseUrl+"/getLocationAuto",
      minLength: 2,
      select: function( event, ui ) { //console.log(event);
        log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );
      }
    });
}

function getProvinceAuto(){
	  $( "#province" ).autocomplete({
      source: baseUrl+"/getProvinceAuto",
      minLength: 2,
      select: function( event, ui ) { //console.log(event);
        log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );
      }
    });	
}

function autoCompleteCompobox(){
	(function( $ ) {
		$.widget( "custom.combobox", {
			_create: function() {
				this.wrapper = $( "<span>" )
				.addClass( "custom-combobox" )
				.insertAfter( this.element );

				this.element.hide();
				this._createAutocomplete();
				this._createShowAllButton();
			},

			_createAutocomplete: function() {
				var selected = this.element.children( ":selected" ),
				value = selected.val() ? selected.text() : "";

				this.input = $( "<input>" )
				.appendTo( this.wrapper )
				.val( value )
				.attr( "title", "" )
				.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
				.autocomplete({
					delay: 0,
					minLength: 0,
					source: $.proxy( this, "_source" )
				})
				.tooltip({
					tooltipClass: "ui-state-highlight"
				});

				this._on( this.input, {
					autocompleteselect: function( event, ui ) {
						ui.item.option.selected = true;
						this._trigger( "select", event, {
							item: ui.item.option
						});
					},

					autocompletechange: "_removeIfInvalid"
				});
			},

			_createShowAllButton: function() {
				var input = this.input,
				wasOpen = false;

				$( "<a>" )
				.attr( "tabIndex", -1 )
				.attr( "title", "Show All Items" )
				.tooltip()
				.appendTo( this.wrapper )
				.button({
					icons: {
						primary: "ui-icon-triangle-1-s"
					},
					text: false
				})
				.removeClass( "ui-corner-all" )
				.addClass( "custom-combobox-toggle ui-corner-right" )
				.mousedown(function() {
					wasOpen = input.autocomplete( "widget" ).is( ":visible" );
				})
				.click(function() {
					input.focus();

            // Close if already visible
            if ( wasOpen ) {
            	return;
            }

            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
        });
			},

			_source: function( request, response ) {
				var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i" );
				response( this.element.children( "option" ).map(function() {
					var text = $( this ).text();
					if ( this.value && ( !request.term || matcher.test(text) ) )
						return {
							label: text,
							value: text,
							option: this
						};
					}) );
			},

			_removeIfInvalid: function( event, ui ) {

				
				if ( ui.item ) {
					return;
				}

				
				var value = this.input.val(),
				valueLowerCase = value.toLowerCase(),
				valid = false;
				this.element.children( "option" ).each(function() {
					if ( $( this ).text().toLowerCase() === valueLowerCase ) {
						this.selected = valid = true;
						return false;
					}
				});

				
				if ( valid ) {
					return;
				}

				
				this.input
				.val( "" )
				.attr( "title", value + " didn't match any item" )
				.tooltip( "open" );
				this.element.val( "" );
				this._delay(function() {
					this.input.tooltip( "close" ).attr( "title", "" );
				}, 2500 );
				this.input.autocomplete( "instance" ).term = "";
			},

			_destroy: function() {
				this.wrapper.remove();
				this.element.show();
			}
		});
	})( jQuery );
}