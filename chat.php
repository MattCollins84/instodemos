<?
  $demosActive = true;
  require_once('includes/header.php');
?>
  
  <!-- chat! -->
  <div class="row-fluid section" id="features">
    <div class="container"> 

      <div class="explain">
        <h2>Chat</h2>
        <p class="intro">Connected users: <span id='connected' class='badge badge-success badge-large'>0</span></p>
        <div class="row-fluid"> 
          
          <div class='span8' id='chatwindow'>
        
            <ul class='unstyled' id='chatlist'>
              
            </ul>
            
          </div>
          
          <div class='span4'>
          
            <form class="mt form">
              <div class="control-group">
                <label class="control-label" for="name">Name</label>
                <div class="controls">
                  <input type="text" id="name" name='name' />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="message">Message</label>
                <div class="controls">
                  <input type="text" id="message" name='message' onkeypress="checkForReturn(event, sendMessage);" class='input-message' />
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                  <button type="button" onclick='sendMessage();' class="btn btn-success">Send Message &raquo;</button>
                </div>
              </div>
            </form>
            
            <h4>Code examples</h4>
            <p>Scroll down to see a simplified code example to help create your own chat system.</p>
            
          </div>
          
        </div> 
            
      </div>
    </div>
  </div>
  
  
  <!-- code! -->
  <div class="row-fluid section" id="features">
    <div class="container"> 

      <div class="explain">
        <p class="intro">How did we do that?</p>
        <div class="row-fluid"> 
          
          <div class='span6'>
            <h2>1. Create a chat area</h2>
            <p>First of all create an area for your chat messages to appear.</p>
<pre class="prettyprint">
  <?
  echo htmlentities("<div id='chatwindow'>
    <ul id='chatlist'></ul>
  </div>\n");
  ?>
</pre>
            <p>And then apply some styling.</p>
<pre class="prettyprint">
  <?
  echo htmlentities("/* CHAT DEMO */
  #chatwindow {
    height: 300px;
    border: 1px solid black;
    overflow: auto;
  }

  ul#chatlist li {
    background: #EFEFEF;
    padding: 5px;
  }

  ul#chatlist li span {
    font-weight: bold;
    display: inline-block;
    width: 100px;
  }

  ul#chatlist li:nth-child(even) {
    background: white;
  }\n");
  ?>
</pre>
          </div>
          
          <div class='span6'>
            <h2>2. Create a form</h2>
            <p>To submit a message, we need some inputs. Create a form with a name and a message text box, and a button.</p>
<pre class="prettyprint">
  <?
echo htmlentities("<form>
    <label>Name</label><input type='text' id='name' name='name' />
    <label>Msg</label><input type='text' id='message' name='message' />
    <button type='button' onclick='sendMessage();'>Send</button>
  </form>\n");
  ?>
</pre>
            <p>Note that this is not a submit button, but a standard button with an on click event.</p>
          </div>
        </div>
        
        <div class="row-fluid">
          <div class='span6'>
            <h2>3. Connect to Insto</h2>
            <p>Set up your connection to Insto, defining your userData, userQuery and a callback function.</p>
            <p>We will look at the callback function in more detail later.</p>
<pre class="prettyprint">
  // callback function
  var callback = function(data) {
    // callback functionality
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
  i = new InstoClient('api_key', userData, userQuery, callback, 'http://insto.server.host:3000'); 
</pre>
            <p>The above says that we are a user with one property (defined in userData): a 'userType' of 'chat'. And we are only concerned about users of the same type (userQuery).</p>
          </div>
          
          <div class='span6'>
            <h2>4. Create a callback function</h2>
            <p>The callback function is what will handle all incoming messages from Insto.</p>
            <p>We are listening to incoming messages from Insto, and if they are of type 'notification' we then render some HTML into the #chatlist element we defined earlier.</p>
<pre class="prettyprint">
  // callback function taking one parameter
  // data - message from insto
  var callback = function(data) {
    // handle incoming messages
    if (data._type == 'notification') {
      var li = "<? echo htmlentities("<li><span class='mr'>"); ?>"+data.name+"<? echo htmlentities("</span>"); ?>"+data.msg+"<? echo htmlentities("</li>"); ?>";
      $('#chatlist').append(li);
    }
  }
</pre>
            <p>This could be taken further to handle the connection/disconnection of users like in our demo, but for the purposes of this explanation we will leave that out. More information can be found in the <a href='/docs'>docs</a>.</p>
          </div>
          
          
      </div>
      
      <div class="row-fluid"> 
          
          <div class='span6'>
            <h2>5. Send your message</h2>
            <p>This is what it's all about, sending your message! And it couldn't be easier.</p>
            <p>The first step is to create a function that we can call whenever we want to send a message.</p>
<pre class="prettyprint">
  // send a message!
  var sendMessage = function() {
    // build our message object
    var sendData = {
      msg: $('#message').val(),
      name: $('#name').val()
    }
    
    // who are we sending this to?
    var sendQuery = {
      userType: "chat"
    }
    
    // send!
    i.send(sendQuery, sendData, true);
  }
</pre>
            <p>This function creates a Javascript object containing all of the data we want to send; in this instance it is simply a name and a message.</p>
            <p>We also create a query object, that defines the person (or people!) we want to receive this message. Remember when we defined our user on connection in step 3? This is what that was for.</p>
            <p>Finally we send all of this to Insto using the .send() method, passing in our query and data. The third parameter in this method is to make sure that the user sending the message also receives it.</p>
          </div>
          
          <div class='span6'>
            <h2>6. Congratulations</h2>
            <p>That is it! At this point you should have a working chat system, using real-time push notifications via Insto.</p>
            <p>Hopefully that didn't take too long and you can now spend the rest of your time adding styles and more features to your chat app to make it a polished product.</p>
            <p>If you haven't already, sign-up now by clicking the link below.</p>
            <p><a href='/signup' class='btn btn-mini btn-success'>Sign-up</a></p>
          </div>
          
          
        </div>
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
    i = new InstoClient('<?=$config['api_key'];?>', userData, userQuery, callback, '<?=$config['insto_host'];?>');
      
    var sendMessage = function() {
      
      // make sure we have a name
      if (!$('#name').val()) {
        alert('You must enter a name.');
        return;
      }
      
      // make name readonly
      $('#name').attr('readonly', 'readonly');
      
      // build our message object
      var sendData = {
        msg: $('#message').val(),
        name: $('#name').val()
      }
      
      // who are we sending this to?
      var sendQuery = {
        userType: "chat"
      }
      
      // send!
      i.send(sendQuery, sendData, true);
      
      // clear out message field
      $('#message').val("");
    }
    
    var checkForReturn = function(e, callback) {
      
      if (e.keyCode == 13) {
        callback();
      }
      
    }
  
  </script>
<?
  require_once('includes/footer.php');  
?>
