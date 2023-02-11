$(document).ready(function() {
  $('#submit-form').on('click', function(event) {
    event.preventDefault();
    var firstName = $('#first-name').val();
    var lastName = $('#last-name').val();
    var email = $('#email').val();
    var file = $('#file-input').val();

    // First Name validation
    if (firstName == '') {
      $('#first-name').addClass('error');
      $('#first-name-error').text('First name is required');
    } else {
      $('#first-name').removeClass('error');
      $('#first-name-error').text('');
    }

    // Last Name validation
    if (lastName == '') {
      $('#last-name').addClass('error');
      $('#last-name-error').text('Last name is required');
    } else {
      $('#last-name').removeClass('error');
      $('#last-name-error').text('');
    }

    // Email validation
    var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!emailRegex.test(email)) {
      $('#email').addClass('error');
      $('#email-error').text('Invalid email address');
    } else {
      $('#email').removeClass('error');
      $('#email-error').text('');
    }

    // File input validation
    if (file == '') {
      $('#file-input').addClass('error');
      $('#file-input-error').text('File is required');
    } else {
      $('#file-input').removeClass('error');
      $('#file-input-error').text('');
    }
     $.ajax({
      type: "POST",
      url: "validate.php",
      data: $(this).serialize(),
      success: function(response) {
        if (response.success) {
          // form was successfully submitted
        } else {
          // form submission failed, display error message
        }
      }
    });

    event.preventDefault();
  });
});
  
