function updateContent(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		content_type: {
	      	required: true,
	    },
		cms_title_1: {
	      	required: true,
	    },
		cms_title_2: {
	      	required: true,
	    },
		cms_content_1: {
	      	required: true,
	    },
		cms_content_2: {
	      	required: true,
	    },
		meta_title_1: {
	      	required: true,
	    },
		meta_title_2: {
	      	required: true,
	    }
	  },
	  messages: {
	  	content_type: {
	      	required: 'Required field.'
	    },
		cms_title_1: {
	      	required: 'Required field.'
	    },
		cms_title_2: {
	      	required: 'Campo requerido.'
	    },
		cms_content_1: {
	      	required: 'Required field.'
	    },
		cms_content_2: {
	      	required: 'Campo requerido.'
	    },
		meta_title_1: {
	      	required: 'Required field.'
	    },
		meta_title_2: {
	      	required: 'Campo requerido.'
	    }
	  },
	  submitHandler: function(form) {
             updatedata(urllink, frmname, returnurl)
			 return false;
         }
	});
}