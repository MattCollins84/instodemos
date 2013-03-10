<?
  $demosActive = true;
  require_once('includes/header.php');
?>
  
  <!-- analytics -->
  <div class="row-fluid section" id="features">
    <div class="container"> 

      <div class="explain">
        <h2>Analytics</h2>
        <p class="intro">Connected users: <span id='connected' class='badge badge-success badge-large'>0</span></p>
        <div class="row"> 
          
          <div class='span8' id='chart' class='analyticsChart'>

            
          </div>
          
          <div class='span4'>
            
            <p>As other users connect the graph will change.</p>
            
            <h4>Code Example</h4>
            <p>Scroll down to see how we did this.</p>
            
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
            <h2>1. Things you'll need</h2>
            <p>We are using the fantastic Google Charts API to render our pie chart, available <a href='https://developers.google.com/chart/'>here</a>.</p>
            <p>We are also using a neat little browser detection script we found at the handy <a href='http://www.quirksmode.org/js/detect.html'>Quirksmode.org</a>.</p>
						
						<p>To load the charts API, do this:</p>
<pre class="prettyprint">
&lt;script type="text/javascript" src="https://www.google.com/jsapi"&gt;&lt;/script&gt;
&lt;script type="text/javascript"&gt;

  // Load the Visualization API and the piechart package.
  google.load('visualization', '1.0', {'packages':['corechart']});

&lt;/script&gt;
</pre>
						
						<p>The browser detect script can be included in the usual way with a &lt;script&gt; tag.</p>
						
          </div>
          
          <div class='span6'>
            <h2>2. Create a chart area</h2>
            <p>First of all, we need somewhere to contain the chart. This is simply a &lt;div&gt; with a unique id. Make sure there is some height on the container also:</p>
            
<pre class="prettyprint">
  &lt;div id='chart' style='height: 400px;'&gt;&lt;/div&gt;
</pre>
            
          </div>
        </div>
      </div>
      
      
      <div class="row-fluid">
          <div class='span6'>
            <h2>3. Connect to Insto</h2>
            <p>Set up your connection to Insto, defining your userData, userQuery and a callback function. Notice how we are using the BrowserDetect script to determine the name of the browser being used.</p>
            <p>We will look at the callback function in more detail later.</p>
<pre class="prettyprint">
  // callback function
  var callback = function(data) {
    // callback functionality
  }
  
  // user data
  var userData = {
    userType: "analytics",
    browser: BrowserDetect.browser
  }
  
  // user query
  var userQuery = {
    userType: "analytics"
  }
  
  //connect to insto
  i = new InstoClient('api_key', userData, userQuery, callback); 
</pre>
            
          </div>
          
          <div class='span6'>
            <h2>4. Draw our chart</h2>
            <p>We need to draw the chart, and update it with our browser type.</p>
            <p>There are lots of examples on the <a href='https://developers.google.com/chart/'>Google Chart API</a> website, but we're going with a simple Pie Chart.</p>
<pre class="prettyprint">
  
var chartData = [
  ['Browser', 'Number']
];

//drawing of chart
function drawVisualization(chartData) {
  // Create and populate the data table.
  var data = google.visualization.arrayToDataTable(chartData);

  // Create and draw the visualization.
  new google.visualization.PieChart(document.getElementById('chart'))
  .draw(data, {title:"Browsers"});
}

drawVisualization(chartData);

var updateChart = function(browser, num) {

// do we have this browser already?
for (var i in chartData) {

  if (chartData[i][0] == browser) {
    chartData[i][1] += num;
    return drawVisualization(chartData);
  }

}

  // if not, add it
  chartData.push([browser, 1]);
  return drawVisualization(chartData);
}

//update with this users details
updateChart(BrowserDetect.browser, 1); 
  
</pre>
            <p>The drawVisualization() function is copied almost straight off the Google Charts API examples page, although it has been changed to accept data via a parameter.</p>
            <p>The updateChart() function is a wrapper around this, accepting a browser name in the first parameter and a number in the second. The plan is to pass either a '1' or a '-1' as the number, to increment or decrement the chart values as required.</p>
          </div>    
      </div>
      
      
      
      <div class="row-fluid">
          <div class='span6'>
            <h2>5. Setup our callback</h2>
            <p>Earlier, we setup a callback function, to handle all of our notifications from Insto, now we need to make it do something.</p>

<pre class="prettyprint">

// callback
var callback = function(data) {

  switch (data._type) {
	
    case "connectedusers":
      connectedUsers(data);
      break;
	
    case "connect":
      userConnect(data);
      break;
	
    case "disconnect":
      userDisconnect(data)
      break;
	
    default:
      break;
  }

}

</pre>
						<p>A simple switch() on the incoming notifications helps to 'direct traffic' to where its needed, each of these functions helping to redraw the graph as needed.</p>
          </div>
          
          <div class='span6'>
            <h2>6. The logic</h2>
            <p>And here are the functions that perform the logic and re-draw the chart.</p>
<pre class='prettyprint'>
// handle connecting
var connectedUsers = function(data) {
  
  // for each connected user
  for (var u in data.users) {
    updateChart(data.users[u].browser, 1);
  }
			 
}

// handle others connecting
var userConnect = function(data) {
  
  // add
  updateChart(data.browser, 1);

}

// handle others disconnecting
var userDisconnect = function(data) {
  
  // remove
  updateChart(data.browser, -1);

}

</pre>
            <p>The connectedUsers() function populates the chart with the data available from other connected users, whilst the userConnect() and userDisconnect() functions add and remove browser data as you might expect.</p>
        </div>    
      </div>
      
      
      <div class="row-fluid">
          <div class='span6'>
            <h2>7. And that's it</h2>
            <p>And that should be it! You can expand on this to track referrers, screen sizes and just about any other metrics you can get your hands on.</p>
          	<p>If you haven't already, sign-up now by clicking the link below.</p>
            <p><a href='/signup' class='btn btn-mini btn-success'>Sign-up</a></p>
          </div>   
      </div>
      
      
      
      
  	</div>
	</div>
	
	
	
		
		
		<script type='text/javascript' src='/js/browserdetect.js'></script>
		<script type='text/javascript'>

			// callback
			var callback = function(data) {
			
				switch (data._type) {
				
					case "connectedusers":
						connectedUsers(data);
						break;
				
					case "connect":
						userConnect(data);
						break;
				
					case "disconnect":
						userDisconnect(data)
						break;
				
					default:
						break;
				}
			
			
			
			}
		
			// handle connecting
			var connectedUsers = function(data) {
			
				var cu = data.users.length+1;
				$('#connected').html(cu);
			
				for (var u in data.users) {
					updateChart(data.users[u].browser, 1);
				}
						 
			}
		
			// handle others connecting
			var userConnect = function(data) {
			
				var cu = parseInt($('#connected').html()) + 1;
				$('#connected').html(cu);
			
				updateChart(data.browser, 1);
			
			}
		
			// handle others disconnecting
			var userDisconnect = function(data) {
			
				var cu = parseInt($('#connected').html()) - 1;
				$('#connected').html(cu);
			
				updateChart(data.browser, -1);
			
			}
		
			var chartData = [
				['Browser', 'Number']
			];
		
			//drawing of chart
			function drawVisualization(chartData) {
				// Create and populate the data table.
				var data = google.visualization.arrayToDataTable(chartData);

				// Create and draw the visualization.
				new google.visualization.PieChart(document.getElementById('chart')).
						draw(data, {title:"Browsers"});
			}

			drawVisualization(chartData);
		
			var updateChart = function(browser, num) {
			
				// do we have this browser already?
				for (var i in chartData) {
				
					if (chartData[i][0] == browser) {
						chartData[i][1] += num;
						return drawVisualization(chartData);
					}
				
				}
			
				// if not, add it
				chartData.push([browser, 1]);
				return drawVisualization(chartData);
			}
		
			//update with this users details
			updateChart(BrowserDetect.browser, 1);
		
			// user data
			var userData = {
				userType: "analytics",
				browser: BrowserDetect.browser
			}
		
			// user query
			var userQuery = {
				userType: "analytics"
			}
		
			//connect to insto
			insto = new InstoClient('<?=$config['api_key'];?>', userData, userQuery, callback <?=($config['insto_host']?", '".$config['insto_host']."'":"");?>);
	
		</script>
  
<?
  require_once('includes/footer.php');  
?>
