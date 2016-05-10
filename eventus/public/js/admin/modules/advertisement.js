function updateAdvertisement(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		advertisement_title_1: {
	      	required: true,
	    },
		advertisement_title_2: {
	      	required: true,
	    },
		position_id: {
	      	required: true,
	    },
		start_date: {
	      	required: true,
	    },
		end_date: {
	      	required: true,
	    },
	    advertisement_link: {
			required: true,
		}
	  },
	  messages: {
	  	advertisement_title_1: {
	      	required: 'Required field.'
	    },
		advertisement_title_2: {
	      	required: 'Campo requerido.'
	    },
		position_id: {
	      	required: 'Required field.'
	    },
		start_date: {
	      	required: 'Required field.'
	    },
		end_date: {
	      	required: 'Required field.'
	    },
	    advertisement_link: {
	      	required: 'Required field.'
	    }
	  },
	  submitHandler: function(form) {
             document.getElementById(frmname).submit();
			 return false;
         }
	});
}