<?php
require_once('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>&raquo; Insto - Real-time, Real-easy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Insto allows you to add real time web technology to your website. Get real time statistics, add real time communication between you and your users and experience the true push of information. With our Realtime Framework, develop your own real time applications.">
    <meta name="keywords" content="realtime, real time, real-time, real time web, realtime web, websockets, web socket, cloud, cloud based, real time statistics, real time framework, framework, web development, developers">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="/css/m-styles.min.css" rel="stylesheet">
    <link href="/css/m-forms.min.css" rel="stylesheet">
    <link href="/css/m-buttons.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <link href="/css/prettify.css" rel="stylesheet">
    <link href="/css/jqueryui.css" rel="stylesheet">
    
    <!-- share this -->
    <script type="text/javascript">var switchTo5x=true;</script>
		<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>

    <script src="/js/jquery.js"></script>
    <script src="/js/jqueryui.js"></script>
    <script src="/js/prettify.js"></script>
    <script src="/js/custom.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>


    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
    
    <script type="text/javascript" src="<?=($config['insto_host']?$config['insto_host']:"http://api.insto.co.uk:3000");?>/lib/client.js"></script>
    
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

    </script>
    

  </head>

  <body onload="prettyPrint()" id="home" data-spy="scroll" data-target=".docsidebar">

		<script type="text/javascript">

			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-37977795-1']);
			_gaq.push(['_trackPageview']);
		
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		
		</script>

    <div class="row header">
       
      <nav class="navbar navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">

            <a class="btn btn-navbar m-btn blue" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>


            <a class='brand' href="/"><img src="/img/top_logo.png" alt="" /></a>                            
    
            <div class="nav-collapse">
                <ul class="nav pull-right">
                  <li <?=($homeActive?'class="active"':'');?>><a href="/" class="anchorLink">Home</a></li>
                  <li <?=($docsActive?'class="active"':'');?>><a href="/docs" class="anchorLink">Docs</a></li>
                  <li <?=($demosActive?'class="active"':'');?>><a href="/demos" class="anchorLink">Demos</a></li>
                  <li <?=($contactActive?'class="active"':'');?>><a href="/contact" class="anchorLink">Contact</a></li>
                  <? if (!isset($_SESSION['user']) || !$_SESSION['user']) { ?>
                    <li <?=($signupActive?'class="active"':'');?>><a href="/signup" class="anchorLink">Sign-up</a></li>
                    <li <?=($signinActive?'class="active"':'');?>><a href="/signin" class="anchorLink">Sign-in</a></li>
                  <? } else { ?>
                    <li <?=($dashboardActive?'class="active"':'');?>><a href="/dashboard" class="anchorLink">Dashboard</a></li>
                    <li><a href="/logout" class="anchorLink">Logout</a></li>
                  <? } ?>
                </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
