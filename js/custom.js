// perform signup request
var signup = function() {
  
  /*
   * VALIDATION
   */
  var error = false;
  $('.control-group').removeClass('error'); 
  $('help-inline').addClass('hidden');
   
  if (!$('input#name').val()) {
    $('.control-group#name-group').addClass('error');
    $('.control-group#name-group .help-inline').removeClass('hidden');
    error = true;
  }
  
  if (!$('input#email').val() || !isEmail($('input#email').val())) {
    $('.control-group#email-group').addClass('error');
    $('.control-group#email-group .help-inline').removeClass('hidden');
    error = true;
  }
  
  if ($('input#password').val().length < 6 || $('input#password').val() != $('input#confirm').val()) {
    $('.control-group#password-group').addClass('error');
    $('.control-group#password-group .help-inline').removeClass('hidden');
    error = true;
  }
  
  if (!$('input#hostname').val()) {
    $('.control-group#hostname-group').addClass('error');
    $('.control-group#hostname-group .help-inline').removeClass('hidden');
    error = true;
  }
  
  if (error === false) {
    $.ajax({
      url: "/signup_ajax.php",
      type: 'POST',
      data: $('#signup-form').serialize()
    }).done(function(data) { 
      console.log(data);
    });
  }
  
}

// validate email address
var isEmail = function(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}