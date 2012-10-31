<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Insto Demos</title>
    
    <meta charset="utf-8">
    
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/style/demos.css" rel="stylesheet">
    
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://localhost:3000/socket.io/socket.io.js"></script>
    <script type="text/javascript" src="http://localhost:3000/lib/client.js"></script>
    
    <style>
      body {
        padding-top: 41px;
      }
    </style>
    
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="/">Insto</a></li>
              <li><a href="/sign-up">Sign-up</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Demos <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/chat">Chat</a></li>
                  <li><a href="/games">Games</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- end nav bar -->
