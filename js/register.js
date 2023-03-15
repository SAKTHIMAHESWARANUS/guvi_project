$(document).ready(function() {
  $('#register-form').submit(function(event) {
    event.preventDefault();

    var formData = {
      name: $('input[name=name]').val(),
      email: $('input[name=email]').val(),
      password: $('input[name=password]').val(),
      confirm_password: $('input[name=confirm_password]').val()
    };

    $.ajax({
      type: 'POST',
      url: 'register.php',
      data: formData,
      dataType: 'json',
      encode: true
    })
    .done(function(data) {
      if (data.success) {
       alert(data.message);
        window.location.replace('login.html');
        
      } else {
        alert(data.message);
      }
    });
  });
});
