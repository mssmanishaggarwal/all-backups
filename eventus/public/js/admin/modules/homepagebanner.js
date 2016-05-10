function updateHomePageBanner(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		banner_title_1: {
	      	required: true,
	    },
		banner_title_2: {
	      	required: true,
	    },
		publish_date: {
	      	required: true,
	    },
		expiry_date: {
	      	required: true,
	    }
	  },
	  messages: {
	  	banner_title_1: {
	      	required: 'Required field.'
	    },
		banner_title_2: {
	      	required: 'Campo requerido.'
	    },
		publish_date: {
	      	required: 'Required field.'
	    },
		expiry_date: {
	      	required: 'Required field.'
	    }
	  },
	  submitHandler: function(form) {
            document.getElementById(frmname).submit();
			 return false;
         }
	});
}