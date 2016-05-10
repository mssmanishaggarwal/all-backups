function updateSubscription(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		subscription_name_1: {
	      	required: true,
	    },
		subscription_name_2: {
	      	required: true,
	    },
		subscription_price: {
	      	required: true,
	    },
		subscription_month: {
	      	required: true,
	    }
	  },
	  messages: {
	  	subscription_name_1: {
	      	required: 'Required field.'
	    },
		subscription_name_2: {
	      	required: 'Campo requerido.'
	    },
		subscription_price: {
	      	required: 'Required field.'
	    },
		subscription_month: {
	      	required: 'Required field.'
	    }
	  },
	  submitHandler: function(form) {
             updatedata(urllink, frmname, returnurl)
			 return false;
         }
	});
}