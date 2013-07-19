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
  
  return false;
  
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

// perform contact request
var contact = function() {
  
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
  
  if (!$('input#subject').val()) {
    $('.control-group#subject-group').addClass('error');
    $('.control-group#subject-group .help-inline').removeClass('hidden');
    error = true;
  }
  
  if (!$('textarea#question').val()) {
    $('.control-group#question-group').addClass('error');
    $('.control-group#question-group .help-block').removeClass('hidden');
    error = true;
  }
  
  return !error;
  
}

// function to calculate connected users
var _users = {};
var calculateConnectedUsers = function(id, direction) {
	
	if (direction == "out" && id) {
		if (_users[id]) {
			delete _users[id];
		}
	} else if (direction == "in" && id) {
		_users[id] = true;
	}
	
	return Object.keys(_users).length;
	
}

// edit a row of API keys
var editRow = function(id) {
  
  $('#row-'+id+' input, #row-'+id+' a, #row-'+id+' span').toggleClass('hidden');
  
}

// save a row of API keys
var saveRow = function(id) {
  
  var hostname = $('#row-'+id+' #hostname').val();
  var dev = $('#row-'+id+' #development_hostname').val();
  var email = $('#row-'+id+' #email').val();
  var password = $('#row-'+id+' #password').val();
  var confirm = $('#row-'+id+' #confirm').val();
  
  if (password && password != confirm) {
    alert('Entered passwords do not match');
    return;
  }

  var data = {
    "id": id,
    hostname: hostname,
    development_hostname: dev,
    email: email
  }
  
  if (password && password == confirm) {
    data.password = password;
  }
  
  $.ajax({
    url: "/update_api_ajax.php",
    type: 'POST',
    data: data,
    dataType: 'json'
  }).done(function(data) { 
    
    
    //$('#row-'+id+' input, #row-'+id+' a, #row-'+id+' span').toggleClass('hidden');
    
    window.location.href = '/dashboard';
    
  });
  
}