$(document).ready(function() {
	$('#profile-form').submit(function(event) {
	  event.preventDefault();
	  
	  var formData = $(this).serialize();
	  
	  
	  $.ajax({
		url: $(this).attr('profile.php'),
		type: $(this).attr('post'),
		data: formData,
		success: function(response) {
		  alert('Profile updated successfully!!!');
		},
		error: function(xhr, status, error) {
		  alert('An error occurred while updating the profile: ' + error);
		}
	  });
	});
  });
