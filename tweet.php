<?
require_once("includes/config.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Insto Tweet Detector</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Insto allows you to add real time web technology to your website. Get real time statistics, add real time communication between you and your users and experience the true push of information. With our Realtime Framework, develop your own real time applications.">
    <meta name="keywords" content="realtime, real time, real-time, real time web, realtime web, websockets, web socket, cloud, cloud based, real time statistics, real time framework, framework, web development, developers">
    <meta name="author" content="">
		
		<link href="/css/dandelion.css" rel="stylesheet">
		
		<script src="/js/paper.js"></script>
		<script src="/js/jquery.js"></script>
		
		<script type="text/paperscript" canvas="canvas" src="/js/dandelion.pjs" id="script"></script>
		
    <script type="text/javascript" src="<?=($config['insto_host']?$config['insto_host']:"http://api.insto.co.uk:3000");?>/lib/client.js"></script>

  </head>

  <body>
  	
  	<div id='header'>
  		<h1>Tweet about Insto and see what happens...</h1>
  	</div>
  	
  	<div id="container">
			<canvas id="canvas" width=800 height=600 data-processing-sources="dandelion.pjs"></canvas>
			<a href="/" id='logo'><img src='/img/top_logo.png' /></a>
			<p id='attr'>With thanks to the clever people <a href='http://zgrossbart.github.com/Dandelion/'>here</a></p>
		</div>
		<ul id='tweets'>
			
		</ul>
  	
  	<script>
  		var tweets = [];
  	
  		// user data
			var userData = {
				userType: "tweeter"
			}
		
			// user query
			var userQuery = {
				userType: "tweeter"
			}
			
			var callback = function(data) {
				console.log(data);
				if (data._type == 'notification') {
					tweet();
					
					var li = "<li><div class='tweet_id'><img class='tweet_logo' src='"+data.logo+"' /><h1>"+data.name+"<br /><span>@"+data.username+"</span></h1></div><p>"+data.text+"</p></li>";
					$('#tweets').prepend(li);
					
					tweets.push(data);
					
				}
			}
		
			//connect to insto
			insto = new InstoClient('98e4bbcec97a36cb591f6d3da62a2754', userData, userQuery, callback , '<?=($config['insto_host']?$config['insto_host']:"http://api.insto.co.uk:3000");?>');
  	</script>
  </body>
</html>