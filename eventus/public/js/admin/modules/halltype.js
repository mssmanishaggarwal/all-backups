function updateHallType(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		hall_type_name_1: {
	      	required: true,
	    },
		hall_type_name_2: {
	      	required: true,
	    }
	  },
	  messages: {
	  	hall_type_name_1: {
	      	required: 'Required field.'
	    },
		hall_type_name_2: {
	      	required: 'Campo requerido.'
	    }
	  },
	  submitHandler: function(form) {
             updatedata(urllink, frmname, returnurl)
			 return false;
         }
	});
}