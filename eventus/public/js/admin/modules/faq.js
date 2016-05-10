function updateFAQ(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		faq_title_1: {
	      	required: true,
	    },
		faq_title_2: {
	      	required: true,
	    },
		faq_content_1: {
	      	required: true,
	    },
		faq_content_2: {
	      	required: true,
	    }
	  },
	  messages: {
	  	faq_title_1: {
	      	required: 'Required field.'
	    },
		faq_title_2: {
	      	required: 'Campo requerido.'
	    },
		faq_content_1: {
	      	required: 'Required field.'
	    },
		faq_content_2: {
	      	required: 'Campo requerido.'
	    }
	  },
	  submitHandler: function(form) {
             updatedata(urllink, frmname, returnurl)
			 return false;
         }
	});
}