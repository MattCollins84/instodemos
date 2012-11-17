// perform signup request
var signup = function() {
  
  /*
   * VALIDATION
   */
  var error = false;
  $('#fail').addClass('hidden');
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
      data: $('#signup-form').serialize(),
      dataType: "json"
    }).done(function(data) { 
      var obj = $.parseJSON(data);
      
      // success
      if (obj.success) {
        window.location.href = "/welcome";
      }
      
      // no success
      else {
        var err = obj.msg.join("<br/>");
        $('#fail').html(err).removeClass('hidden');
      }
      
    });
  }
  
}

// perform signin request
var signin = function() {
  
  /*
   * VALIDATION
   */
  var error = false;
  $('#fail').addClass('hidden');
  $('.control-group').removeClass('error'); 
  $('help-inline').addClass('hidden');
   
  if (!$('input#email').val() || !isEmail($('input#email').val())) {
    $('.control-group#email-group').addClass('error');
    $('.control-group#email-group .help-inline').removeClass('hidden');
    error = true;
  }
  
  if (!$('input#password').val()) {
    $('.control-group#password-group').addClass('error');
    $('.control-group#password-group .help-inline').removeClass('hidden');
    error = true;
  }
  
  if (error === false) {
    $.ajax({
      url: "/signin_ajax.php",
      type: 'POST',
      data: $('#signin-form').serialize(),
      dataType: "json"
    }).done(function(data) { 
      console.log(data);
      // if we have some results
      if (data.success) {
        window.location.href = '/dashboard';
      }
      
      else {
        $('#fail').removeClass('hidden');
      }
      
    });
  }
  
}

// validate email address
var isEmail = function(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

// select host/apikey for usage details
var selectUsage = function(id, key) {
  
  $('#usage-list li').removeClass('active');
  $('#usage'+id).addClass('active');
  
  $.ajax({
    url: "/usage_ajax.php",
    type: 'POST',
    data: {"key": key},
    dataType: 'html'
  }).done(function(data) { 
    
    
    $('#usage-info').html(data);
    
    
  });
}
