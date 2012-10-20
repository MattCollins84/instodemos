<?
  require_once('includes/header.php');
?>
  
  <div class='container' id='main'>
  
    <div class='row'>
    
      <h1>Connected Users: <span id='connected' class='badge badge-success badge-large'>0</span></h1>
    
    </div>
    
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
        
        var li = "<li><span class='mr'>"+data.msg.name+"</span>"+data.msg.msg+"</li>";
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
    i = new InstoClient(userData, userQuery, callback, 'http://localhost:3000');
      
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
