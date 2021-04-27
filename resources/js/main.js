/* Register form validation*/
$(document).ready(function() {
  $("#basic-form").validate({
    rules: {
      name : {
        required: true,
        minlength: 3
      },
      email: {
        required: true,
        email: true
      },
      password: {
                  required:true,
                  rangelenght:[4.20]
                },
      confirm_password: {
        required:true,
        rangelenght:[4.20]
      }
    },
    messages : {
      name: {
        minlength: "Name should be at least 3 characters"
      },
      email: {
        email: "The email should be in the format: abc@domain.tld"
      }
     
    }
  });
}); 

  setTimeout(function(){
  $('.msg').remove();
}, 5000);