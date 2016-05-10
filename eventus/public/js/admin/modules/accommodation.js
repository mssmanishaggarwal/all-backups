function updateAccommodation(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		accommodation_name_1: {
	      	required: true,
	    },
		accommodation_name_2: {
	      	required: true,
	    }
	  },
	  messages: {
	  	accommodation_name_1: {
	      	required: 'Required field.'
	    },
		accommodation_name_2: {
	      	required: 'Campo requerido.'
	    }
	  },
	  submitHandler: function(form) {
             updatedata(urllink, frmname, returnurl)
			 return false;
         }
	});
}