function updatePriceRange(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		price_range_title_1: {
	      	required: true,
	    },
		price_range_title_2: {
	      	required: true,
	    }
	  },
	  messages: {
	  	price_range_title_1: {
	      	required: 'Required field.'
	    },
		price_range_title_2: {
	      	required: 'Campo requerido.'
	    }
	  },
	  submitHandler: function(form) {
             updatedata(urllink, frmname, returnurl)
			 return false;
         }
	});
}