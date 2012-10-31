<?
  require_once('includes/header.php');
?>
  
  <header class='jumbotron minitron'>
    <div class='container'>
      <div class='row'>
        
        <div class='span6'>
          <h1>Games</h1>
          <p>Example pictionary style game</p>
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
      
      <div class='span10'>
        <canvas id="drawingCanvas" width="900px" height="300px" style="box-shadow: 2px 2px 5px 2px #ACACAC;">
          <p>Your browser does not support HTML5. <br/>Upgrade it window licker!</p>
        </canvas>
      </div>
      
      <div class='span2'>
        
        <h3>Pick a colour</h3>
        
        <div class='colourpick red' onclick="pickcolour('red')"></div>
        
        <div class='colourpick green' onclick="pickcolour('green')"></div>
        
        <div class='colourpick blue' onclick="pickcolour('blue')"></div>
        
      </div>
      
    </div>
  
  </div>
  
  <script type='text/javascript'>
    
    var i;
    // callback
    var callback = function(data) {
      
      // handle messages
      if (data._type == 'notification') {
        
        if (data.action == "move") {
          moveTo(data.x, data.y);
        }
        
        if (data.action == "draw") {
          draw(data.x, data.y);
        }
        
        if (data.action == "colour") {
          canvasContext.strokeStyle = data.colour;
        }
        
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
      userType: "games"
    }
    
    // user query
    var userQuery = {
      userType: "games"
    }
    
    //connect to insto
    i = new InstoClient('key', userData, userQuery, callback, 'http://localhost:3000');
  
  </script>
  <script type='text/javascript' src='/js/games.js'></script>
<?
  require_once('includes/footer.php');  
?>
