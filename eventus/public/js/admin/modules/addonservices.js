function updateAddon(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		addon_name_1: {
	      	required: true,
	    },
		addon_name_2: {
	      	required: true,
	    }
	  },
	  messages: {
	  	addon_name_1: {
	      	required: 'Required field.'
	    },
		addon_name_2: {
	      	required: 'Campo requerido.'
	    }
	  },
	  submitHandler: function(form) {
             updatedata(urllink, frmname, returnurl)
			 return false;
         }
	});
}