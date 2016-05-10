function updateUser(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		user: {
	      	required: true
	    },
		email: {
	      	required: true,
			email:true
	    },
		password: {
	      	required: true,
			min:10
	    },
		first_name: {
	      	required: true,
	    },
		last_name: {
	      	required: true,
	    },
		contact_number: {
	      	required: true,
	    },
		address: {
	      	required: true,
	    },
		city: {
	      	required: true,
	    },
		state: {
	      	required: true,
	    },
		country: {
	      	required: true,
	    }
		
	  },
	  messages: {
	  	email: {
	      	required: 'Required field.',
			email:'Invalid email'
	    },
		password: {
	      	required: 'Required field.'
	    },
		first_name: {
	      	required: 'Required field.'
	    },
		last_name: {
	      	required: 'Required field.'
	    },
		contact_number: {
	      	required: 'Required field.'
	    },
		address: {
	      	required: 'Required field.'
	    },
		city: {
	      	required: 'Required field.'
	    },
		state: {
	      	required: 'Required field.'
	    },
		country: {
	      	required: 'Required field.'
	    }
		
	  },
	  submitHandler: function(form) {
             updateUserdata(urllink, frmname, returnurl)
			 return false;
         }
	});
}