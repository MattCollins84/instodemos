<?
  require_once('includes/header.php');
?>
  
  <header class='jumbotron minitron'>
    <div class='container'>
      <div class='row'>
        
        <div class='span6'>
          <h1>Chat</h1>
          <p>Real-time chat with Insto</p>
        </div>
        
        <div class='span5'>
          
          <div id='header-buttons'>
            
            <h2>Connected Users: <span id='connected' class='badge badge-success badge-large'>0</span></h2>
            
            
          </div>
          
          
        </div>
        
      </div>
    </div>
  </header>
  
  <div class='container' id='main'>
    
    <div class='row'>
      
      <div id='chatwindow'>
        
        <ul class='unstyled' id='chatlist'>
          
        </ul>
        
      </div>
      
      <form class="mt form-horizontal">
        <div class="control-group">
          <label class="control-label" for="name">Name</label>
          <div class="controls">
            <input type="text" id="name" name='name' />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="message">Message</label>
          <div class="controls">
            <input type="text" id="message" name='message' class='input-message' />
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <button type="button" onclick='sendMessage();' class="btn">Send Message</button>
          </div>
        </div>
      </form>
      
    </div>
  
  </div>
  
  <script type='text/javascript'>
    
    var i;
    // callback
    var callback = function(data) {
      console.log(data);
      
      // handle messages
      if (data._type == 'notification') {
        
        var li = "<li><span class='mr'>"+data.name+"</span>"+data.msg+"</li>";
        $('#chatlist').append(li);
        
      }
      
      // handle connecting
      if (data._type == 'connectedusers') {
        
        var cu = data.users.length+1;
        $('#connected').html(cu);
        
      }
      
      // handle others connecting
      if (data._type == 'connect') {
        
        var cu = parseInt($('#connected').html()) + 1;
        $('#connected').html(cu);
        
      }
      
      // handle others disconnecting
      if (data._type == 'disconnect') {
        
        var cu = parseInt($('#connected').html()) - 1;
        $('#connected').html(cu);
        
      }
    }
    
    // user data
    var userData = {
      userType: "chat"
    }
    
    // user query
    var userQuery = {
      userType: "chat"
    }
    
    //connect to insto
    i = new InstoClient('key', userData, userQuery, callback, 'http://localhost:3000');
      
    var sendMessage = function() {
      
      if (!$('#name').val()) {
        alert('You must enter a name.');
        return;
      }
      
      $('#name').attr('readonly', 'readonly');
      
      var sendData = {
        msg: $('#message').val(),
        name: $('#name').val()
      }
      
      var sendQuery = {
        userType: "chat"
      }
      
      i.send(sendQuery, sendData, true);
      
    }
  
  </script>
<?
  require_once('includes/footer.php');  
?>
