<?
  $demosActive = true;
  require_once('includes/header.php');
?>
  
  <!-- chat! -->
  <div class="row-fluid section" id="features">
    <div class="container"> 

      <div class="explain">
        <h2>Shared Drawing</h2>
        <p class="intro">Connected users: <span id='connected' class='badge badge-success badge-large'>0</span></p>
        <div class="row"> 
          
          <div class='span8'>
        
            <canvas id="drawingCanvas" width="700px" height="300px" style="box-shadow: 2px 2px 5px 2px #ACACAC;">
              <p>Your browser does not support HTML5.</p>
            </canvas>
            
          </div>
          
          <div class='span4'>
          
            <h3>Pick a colour</h3>
        
            <div class='colourpick red' onclick="pickcolour('red')"></div>
            
            <div class='colourpick green' onclick="pickcolour('green')"></div>
            
            <div class='colourpick blue' onclick="pickcolour('blue')"></div>
            
          </div>
          
        </div> 
            
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
    i = new InstoClient('<?=$config['api_key'];?>', userData, userQuery, callback, <?=($config['insto_host']?", '".$config['insto_host']."'":"");?>);
  
  </script>
  <script type='text/javascript' src='/js/draw.js'></script>
  
<?
  require_once('includes/footer.php');  
?>
