var Login = function () {   
    return {
        //main function to initiate the module
        init: function () {        
           // handleLogin();
           // handleForgetPassword();
           // handleRegister(); 
		   
			var baseurl = $('#baseUrl').val();
            $.backstretch([
		        ""+baseurl+"/public/images/admin/img/1.jpg",
		        ""+baseurl+"/public/images/admin/img/2.jpg",
		      	 ""+baseurl+"/public/images/admin/img/3.jpg"
		        //""+baseurl+"img/4.jpg"
		        ], {
		          fade: 1000,
		          duration: 5000
		    });	       
        }
    };
}();