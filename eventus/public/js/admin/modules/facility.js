function updateFacility(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		facilities_name_1: {
	      	required: true,
	    },
		facilities_name_2: {
	      	required: true,
	    }
	  },
	  messages: {
	  	facilities_name_1: {
	      	required: 'Required field.'
	    },
		facilities_name_2: {
	      	required: 'Campo requerido.'
	    }
	  },
	  submitHandler: function(form) {
             updatedata(urllink, frmname, returnurl)
			 return false;
         }
	});
}