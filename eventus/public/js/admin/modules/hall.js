function updateHalls(urllink, frmname, returnurl){
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		hall_name: {
	      	required: true
	    },
	    hall_description: {
	      	required: true
	    },
	    hall_address: {
			required: true
		},
		location: {
			required: true
		},
		province: {
			required: true
		},
		lat: {
			required: true
		},
		lng: {
			required: true
		},
		rental_amount: {
			required: true
		},
		official_name: {
			required: true
		},
		contact_name: {
			required: true
		},
		contact_email: {
			required: true
		},
		contact_mobile: {
			required: true
		},
		user_id: {
			required: true
		},
	  },
	  messages: {
	  	hall_name: {
	      	required: 'Required field.'
	    },
	    hall_description: {
			 required: 'Required field.'
		},
		hall_address: {
			required: 'Required field.'
		},
		location: {
			required: 'Required field.'
		},
		province: {
			required: 'Required field.'
		},
		lat: {
			required: 'Required field.'
		},
		lng: {
			required: 'Required field.'
		},
		rental_amount: {
			required: 'Required field.'
		},
		official_name: {
			required: 'Required field.'
		},
		contact_name: {
			required: 'Required field.'
		},
		contact_email: {
			required: 'Required field.'
		},
		contact_mobile: {
			required: 'Required field.'
		},
		user_id: {
			required: 'Required field.'
		},
	  },
	  submitHandler: function(form) {
            document.getElementById(frmname).submit();
			return false;
         }
	});
}