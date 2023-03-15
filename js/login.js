$(document).ready(function() {
    $('#login-form').submit(function(event) {
      event.preventDefault();
  
      
      var formData = {
        email: $('input[name=email]').val(),
        password: $('input[name=password]').val()
      };
  
      
      $.ajax({
        type: 'POST',
        url: 'login.php',
        data: formData,
        dataType: 'json',
        encode: true
      })
      .done(function(data) {
        if (data.success) {
          alert(data.message);
          window.location.replace('profile.html');
          
        } else {
          alert(data.message);
          window.location.replace('login.html');
        }
      });
    });
  });
  