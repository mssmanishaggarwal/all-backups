function updateNews(urllink, frmname, returnurl){	
	$("#"+frmname).validate({
	  errorElement:'span',
	  rules: { 
		news_title_1: {
	      	required: true,
	    },
		news_title_2: {
	      	required: true,
	    },
		news_content_1: {
	      	required: true,
	    },
		news_content_2: {
	      	required: true,
	    },
		created_by: {
	      	required: true,
	    },
		published_date: {
	      	required: true,
	    }
	  },
	  messages: {
	  	news_title_1: {
	      	required: 'Required field.'
	    },
		news_title_2: {
	      	required: 'Campo requerido.'
	    },
		news_content_1: {
	      	required: 'Required field.'
	    },
		news_content_2: {
	      	required: 'Campo requerido.'
	    },
		created_by: {
	      	required: 'Required field.'
	    },
		published_date: {
	      	required: 'Required field.'
	    }
	  },
	  submitHandler: function(form) {
            document.getElementById(frmname).submit();
			 return false;
         }
	});
}