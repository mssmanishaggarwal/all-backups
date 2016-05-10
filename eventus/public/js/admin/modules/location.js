function updateLocation(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		location_name_1: {
	      	required: true,
	    },
		location_name_2: {
	      	required: true,
	    }
	  },
	  messages: {
	  	location_name_1: {
	      	required: 'Required field.'
	    },
		location_name_2: {
	      	required: 'Campo requerido.'
	    }
	  },
	  submitHandler: function(form) {
             updatedata(urllink, frmname, returnurl)
			 return false;
         }
	});
}