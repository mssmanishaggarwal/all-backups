$(document).ready(function() {

   $('#loginsubmitbutton').click(function() {

      $("#myform").validate({
         errorElement: "label",

         rules: {
            email: "required",
            password: "required",
         },
         messages: {
            email: "Please Enter Email Id",
            password: {
               required: "Please Enter password"

            },
         },
         errorPlacement: function() {
            return false;
         },

         submitHandler: function(form) {

            form.submit();
         },
      });
   });




});
// ko load login data from database
//# sourceMappingURL=login.js.map
