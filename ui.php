<?
  $demosActive = true;
  $title = "UI Demo";
  require_once('includes/header.php');
?>
  
  <!-- chat! -->
  <div class="row-fluid section" id="features">
    <div class="container"> 

      <div class="explain">
        <h2>UI Sync</h2>
        <p class="intro">Connected users: <span id='connected' class='badge badge-success badge-large'>0</span></p>
        <div class="row"> 
          
          <div class='span8'>
            
            
            <div class='slide' id='red'></div>
            <div class='slide' id='green'></div>
            <div class='slide' id='blue'></div>
            
          </div>
          
          <div class='span4'>
            
            <p>Move the sliders to change the colour of the box.</p>
            
            <div id='colourbox'>
            </div>
            
            <h4>Code Example</h4>
            <p>Scroll down to see how we did this.</p>
            
          </div>
          
        </div> 
            
      </div>
    </div>
  </div>
  
  
  
  
  <!-- code! -->
  <div class="row-fluid section">
    <div class="container"> 

      <div class="explain">
        <p class="intro">How did we do that?</p>
        <div class="row-fluid"> 
          
          <div class='span6'>
            <h2>1. Create your sliders</h2>
            <p>We are using the handy slider widget from <a href='http://api.jqueryui.com/slider/'>jQuery UI</a>, so make sure you download that.</p>
            <p>Create a slider for each colour, and a box to be the target of our colour changes.</p>
<pre class="prettyprint">
  <?
  echo htmlentities("<div class='slide' id='red'></div>
  <div class='slide' id='green'></div>
  <div class='slide' id='blue'></div>
  <div id='colourbox'></div>\n");
  ?>
</pre>
            <p>And then apply some styling</p>
<pre class="prettyprint">
  <?
  echo htmlentities("#colourbox {
    position: relative;
    height: 50px;
    border: 5px solid white;
    background: black;
  }

  #red {
    background: #f78c99;
  }

  #green {
    background: #ccdeaf;
  }

  #blue {
    background: #7e95c2;
  }

  .slide {
    margin-bottom: 10px;
  }\n");
  ?>
</pre>
          </div>
          
          <div class='span6'>
            <h2>2. Enable your sliders</h2>
            <p>First of all, we need to enable our sliders and set them up with some properties.</p>
<pre class="prettyprint">
  var red = [0, 255];
  var green = [0, 255];
  var blue = [0, 255];

  $(function() {
    $( "#red" ).slider({ min: 0, max: 255, animate: "fast", values: red }).bind('slidestop',function(event,ui){
      changeColour('red', ui.values);
    });
    $( "#green" ).slider({ min: 0, max: 255, animate: "fast", values: green }).bind('slidestop',function(event,ui){
      changeColour('green', ui.values);
    });
    $( "#blue" ).slider({ min: 0, max: 255, animate: "fast", values: blue }).bind('slidestop',function(event,ui){
      changeColour('blue', ui.values);
    });
  });
</pre>
            <p>The above Javascript has enabled our sliders, set the range to be between 0 and 255, and set the default positions for the sliders (0 for the first handle, 255 for the second).</p>
            <p>It is also making a call to a new function 'changeColour' after each slider has changed, passing in the colour that changed, and it's new values.</p>
          </div>
        </div>
        
        <div class="row-fluid">
          <div class='span6'>
            <h2>3. Connect to Insto</h2>
            <p>Set up your connection to Insto, defining your userData, userQuery and callback functions.</p>
            <p>We will look at the callback functions in more detail later.</p>
<pre class="prettyprint">
  // user data
  var userData = {
    userType: "ui",
    id: Math.random().toString()
  }
  
  // user query
  var userQuery = {
    userType: "ui"
  }
  
  //connect to insto
  i = new InstoClient('api_key', userData, userQuery, {
    onConnectedUsers: function(data) { ... },
    onNotification: function(data) { ... }
  }); 
</pre>
            <p>The above says that we are a user with two properties (defined in userData): a 'userType' of 'ui' and a random ID number. This ID number will be used later in the example.</p>
            <p>We are only concerned about users of the same type (userQuery).</p>
          </div>
          
          <div class='span6'>
            <h2>4. Change the colours!</h2>
            <p>First of all we need a function to change the colour values locally: changeColour.</p>
            <p>We also need to create a function to render the changes on the screen.</p>
<pre class="prettyprint">
  var changeColour = function(colour, values) {
    
    switch (colour) {
      case 'red':
        red = values;
        break;
      case 'green':
        green = values;
        break;
      case 'blue':
        blue = values;
        break;
    }
    
    render();
    
    i.send({userType:'ui'}, {red: red, green: green, blue: blue});
    
  };
  
  var render = function() {
    $('#colourbox').css('backgroundColor', 'rgb('+red[0]+','+green[0]+','+blue[0]+')');
    $('#colourbox').css('borderColor', 'rgb('+red[1]+','+green[1]+','+blue[1]+')');
  }
</pre>
            <p>These functions combine to change the stored colour values, and render out the changes in the browser. It also sends these colours to any other connected users, using the .send() method.</p>
          </div>
          
          
      </div>
      
      <div class="row-fluid"> 
          
          <div class='span6'>
            <h2>5. Handle incoming notifications</h2>
            <p>So someone has changed the colours at their end, now you need to handle the incoming notifications to render the changes at your end.</p>
            <p>This is done in the callback:</p>
<pre class="prettyprint">
  //connect to insto
  i = new InstoClient('api_key', userData, userQuery, {
    
    // sync up with existing users   
    onConnectedUsers: function(data) { ... },
    
    // handle incoming notifications
    onNotification: function(data) {
      red = data.red;
      green = data.green;
      blue = data.blue;

      $('#red').slider('values', red);
      $('#green').slider('values', green);
      $('#blue').slider('values', blue);

      render();
    }
  });
</pre>
            <p>Here we are receiving data from another user, telling us what the new values for the sliders should be, and applying these values locally. Notice the use of the render() function we defined earlier.</p>
          </div>
          
          <div class='span6'>
            <h2>6. Syncing views (pt. 1)</h2>
            <p>At this point you should have a simple application that allows you to change the colours on multiple browsers in realtime.</p>
            <p>But for a truly synchronised experience, we should really make sure that whenever a new user connects, they are immediately caught up with the current view.</p>
            <p>When a new client connects, Insto automatically sends them all of the connected clients in their userQuery. In this example we asked to be notified of all users with a userType of 'ui'.</p>
            <p>We can then ask one of these fellow users to send us the current state of play by using the <b>onConnectedUsers</b> callback:</p>
<pre class="prettyprint">
  //connect to insto
  i = new InstoClient('api_key', userData, userQuery, {
    
    // sync up with existing users   
    onConnectedUsers: function(data) {
      var cu = data.users.length+1;
      $('#connected').html(cu);
      
      // get current context
      if (data.users.length) {
        var contextQuery = data.users[0];
        i.send(contextQuery, {context: false, id: userData.id});
      }
    },
    
    // handle incoming notifications
    onNotification: function(data) {
      red = data.red;
      green = data.green;
      blue = data.blue;

      $('#red').slider('values', red);
      $('#green').slider('values', green);
      $('#blue').slider('values', blue);

      render();
    }
  });
</pre>
            <p>Here we are listening for the 'connectedusers' notification, and if we receive any connected users, we send a notification to this user asking for details of the current view.</p>
          </div>
          
          
        </div>
    </div>
    
    
    <div class="row-fluid"> 
          
          <div class='span6'>
            <h2>7. Syncing views (pt. 2)</h2>
            <p>Finally, we need to be able to respond to the request for the latest view, and be able to process this data when it is sent to us.</p>
            <p>This is done by extending the callback a bit. The new callback is shown below, and is looked at in more detail in section 8.</p>
<pre class="prettyprint">
  //connect to insto
  i = new InstoClient('api_key', userData, userQuery, {
    
    // sync up with existing users   
    onConnectedUsers: function(data) {
      var cu = data.users.length+1;
      $('#connected').html(cu);
      
      // get current context
      if (data.users.length) {
        var contextQuery = data.users[0];
        i.send(contextQuery, {context: false, id: userData.id});
      }
    },
    
    // handle incoming notifications
    onNotification: function(data) {
      // not a context request?
      if (typeof data.context == 'undefined') {
        red = data.red;
        green = data.green;
        blue = data.blue;
        
        $('#red').slider('values', red);
        $('#green').slider('values', green);
        $('#blue').slider('values', blue);
        
        render();
      }
      
      // handle context
      else {
        
        // no context supplied? send context back
        if (data.context === false) {
          
          var sendContext = {
            context: {
              red: red,
              green: green,
              blue: blue
            }
          }
          
          var sendContextquery = {
            id: data.id,
            userType: 'ui'
          }
          
          i.send(sendContextquery, sendContext);
          
        }
        
        // if a context is supplied, do it!
        else if (typeof data.context == 'object') {
          
          red = data.context.red;
          green = data.context.green;
          blue = data.context.blue;
          
          $('#red').slider('values', red);
          $('#green').slider('values', green);
          $('#blue').slider('values', blue);
          
          render();
          
        }
      }
    }
  });
</pre>

            <p>Here we are receiving data from another user, telling us what the new values for the sliders should be, and applying these values locally. Notice the use of the render() function we defined earlier.</p>
          </div>
          
          <div class='span6'>
            <h2>8. Syncing views (pt. 3)</h2>
            <p>Here is a quick overview of the callback function as a whole.</p>
            <p>This section simply handles the incoming data from another user, and calls the rendering function to make the change on the screen.</p>
<pre class="prettyprint">
onNotification: function(data) {
  // not a context request?
  if (typeof data.context == 'undefined') {
    red = data.red;
    green = data.green;
    blue = data.blue;
    
    $('#red').slider('values', red);
    $('#green').slider('values', green);
    $('#blue').slider('values', blue);
    
    render();
  }
</pre>
            <p>In this section we are saying that, if we receive a context property, with a value of false - then we know this is a request for the current view from someone else. Simply build the object and return it to the user.</p>
            <p>Note that the requesting user has also supplied his own unique ID in the message, so we know who to respond to.</p>
<pre class="prettyprint">  
  // no context supplied? send context back
  if (data.context === false) {
    
    var sendContext = {
      context: {
        red: red,
        green: green,
        blue: blue
      }
    }
    
    var sendContextquery = {
      id: data.id,
      userType: 'ui'
    }
    
    i.send(sendContextquery, sendContext);
    
  }
</pre>
            <p>Alternatively, if the context property is an object, it contains the data we need to render out the starting point of our view.</p>
<pre class="prettyprint">   
  // if a context is supplied, do it!
  else if (typeof data.context == 'object') {
    
    red = data.context.red;
    green = data.context.green;
    blue = data.context.blue;
    
    $('#red').slider('values', red);
    $('#green').slider('values', green);
    $('#blue').slider('values', blue);
    
    render();
    
  }
}
</pre>
            <p>Here we are listening for the 'connectedusers' notification, and if we receive any connected users, we send a notification to this user asking for details of the current view.</p>
<pre class="prettyprint"> 
// handle connecting
onConnectedUsers: function(data) {
  
  var cu = data.users.length+1;
  $('#connected').html(cu);
  
  // get current context
  if (data.users.length) {
    var contextQuery = data.users[0];
    i.send(contextQuery, {context: false, id: userData.id});
  }
}
</pre>
              <p>You should now have a fully working application. If not, why not sign-up for free and have a go?</p>
              <p><a href='/signup' class='btn btn-mini btn-success'>Sign-up</a></p>
            </div>
        </div>
    </div>
  </div>
  
  <script type='text/javascript'>
    
    var red = [0, 255];
    var green = [0, 255];
    var blue = [0, 255];
    
    $(function() {
      $( "#red" ).slider({ min: 0, max: 255, animate: "fast", values: red }).bind('slidestop',function(event,ui){
        changeColour('red', ui.values);
      });
      $( "#green" ).slider({ min: 0, max: 255, animate: "fast", values: green }).bind('slidestop',function(event,ui){
        changeColour('green', ui.values);
      });
      $( "#blue" ).slider({ min: 0, max: 255, animate: "fast", values: blue }).bind('slidestop',function(event,ui){
        changeColour('blue', ui.values);
      });
    });
    
    
    
    var changeColour = function(colour, values) {
      
      switch (colour) {
        case 'red':
          red = values;
          break;
        case 'green':
          green = values;
          break;
        case 'blue':
          blue = values;
          break;
      }
      
      render();
      
      insto.send({userType:'ui'}, {red: red, green: green, blue: blue});
      
    };
    
    var render = function() {
      $('#colourbox').css('backgroundColor', 'rgb('+red[0]+','+green[0]+','+blue[0]+')');
      $('#colourbox').css('borderColor', 'rgb('+red[1]+','+green[1]+','+blue[1]+')');
    }
    
    var insto;
    // user data
    var userData = {
      userType: "ui",
      id: Math.random().toString()
    }
    
    // user query
    var userQuery = {
      userType: "ui"
    }
    
    //connect to insto
    insto = new InstoClient('<?=$config['api_key'];?>', userData, userQuery, {
    	
    	// on connect
    	onConnect: function(data) {
    		$('#connected').html(calculateConnectedUsers(data._id, "in"));
    	},
    	
    	// other connected users
    	onConnectedUsers: function(data) {
    		
    		for (var u in data.users) {
        	$('#connected').html(calculateConnectedUsers(data.users[u]._id, "in"));
        }
        
        // get current context
        if (data.users.length) {
          var contextQuery = data.users[0];
          insto.send(contextQuery, {context: false, id: userData.id});
        }
        
    	},
    	
    	// for each notification
    	onNotification: function(data) {
    		
    		// not a context request?
        if (typeof data.context == 'undefined') {
          red = data.red;
          green = data.green;
          blue = data.blue;
          
          $('#red').slider('values', red);
          $('#green').slider('values', green);
          $('#blue').slider('values', blue);
          
          render();
        }
        
        // handle context
        else {
          
          // no context supplied? send context back
          if (data.context === false) {
            
            var sendContext = {
              context: {
                red: red,
                green: green,
                blue: blue
              }
            }
            
            var sendContextquery = {
              id: data.id,
              userType: 'ui'
            }
            
            insto.send(sendContextquery, sendContext);
            
          }
          
          // if a context is supplied, do it!
          else if (typeof data.context == 'object') {
            
            red = data.context.red;
            green = data.context.green;
            blue = data.context.blue;
            
            $('#red').slider('values', red);
            $('#green').slider('values', green);
            $('#blue').slider('values', blue);
            
            render();
            
          }
      	} 
        
    	},
    	
    	// when a user connects
    	onUserConnect: function(data) {
    		$('#connected').html(calculateConnectedUsers(data._id, "in"));
    	},
    	
    	// when a user disconnects
    	onUserDisconnect: function(data) {
  			$('#connected').html(calculateConnectedUsers(data._id, "out"));
    	}
    	
    }<?=($config['insto_host']?", '".$config['insto_host']."'":"");?>);
  
  </script>
  
<?
  require_once('includes/footer.php');  
?>
