function updateEmail(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		email_title: {
	      	required: true,
	    },
		email_subject_1: {
	      	required: true,
	    },
		email_subject_2: {
	      	required: true,
	    },
		email_body_1: {
	      	required: true,
	    },
		email_body_2: {
	      	required: true,
	    }
	  },
	  messages: {
	  	email_title: {
	      	required: 'Required field.'
	    },
		email_subject_1: {
	      	required: 'Required field.'
	    },
		email_subject_2: {
	      	required: 'Campo requerido.'
	    },
		email_body_1: {
	      	required: 'Required field.'
	    },
		email_body_2: {
	      	required: 'Campo requerido.'
	    }
	  },
	  submitHandler: function(form) {
             updatedata(urllink, frmname, returnurl)
			 return false;
         }
	});
}