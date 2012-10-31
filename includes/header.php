<?
  $config = array();
  $config['api_key'] = ($_SERVER['HTTP_HOST']=="insto.mattcollins.com"?"key":"strikes");
  $config['insto_host'] = ($_SERVER['HTTP_HOST']=="insto.mattcollins.com"?"http://localhost:3000":"http://ec2-176-34-91-164.eu-west-1.compute.amazonaws.com:3000");
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>&raquo; Insto - Real-time, Real-easy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
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
    
    <script type="text/javascript" src="<?=$config['insto_host'];?>/socket.io/socket.io.js"></script>
    <script type="text/javascript" src="<?=$config['insto_host'];?>/lib/client.js"></script>

  </head>

  <body onload="prettyPrint()" id="home" data-spy="scroll" data-target=".navbar">

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
                  <li <?=($signupActive?'class="active"':'');?>><a href="/signup" class="anchorLink">Sign-up</a></li>
                  <li <?=($docsActive?'class="active"':'');?>><a href="/docs" class="anchorLink">Docs</a></li>
                  <li <?=($demosActive?'class="active"':'');?>><a href="/demos" class="anchorLink">Demos</a></li>
                </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
