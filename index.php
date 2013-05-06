<?
  $homeActive = true;
  require_once('includes/header.php');
?>

    <!-- Masthead -->
    <div class="full callout">
      <div class="container">
        <div class="row">
          <div class="span12 companycallout">
          <img class='calloutlogo' src="/img/full_logo.png" alt="insto" />
          <h1>REAL-TIME. <span>REAL EASY.</span></h1>
          <p><a class="btn btn-success btn-large" href="/signup">Sign-up free &raquo;</a></p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- features -->
    <div class="row-fluid section section-last" id="features">
      <div class="container"> 

        <div class="explain">
          <p class="intro">Create amazing real-time applications. Simply.</p>
          <div class="row-fluid"> 
            <div class="span4">
              <h3>What is it?</h3>
              <p>Insto is an API designed to bring the real-time web to your application, in the simplest way possible.</p>
              <p>Our Javascript library and REST API lets you add scalable real-time functionality within minutes, without any of the hassle.</p>
            </div>

            <div class="span4">
              <h3>How does it work?</h3>
              <p>Insto utilises a combination of <a href='http://www.websocket.org/' target='_blank'>HTML5 Websockets</a> and <a href='http://nodejs.org' target='_blank'>Node.JS</a> to make the real-time communication possible, with our Javascript library providing compatibility all the way back to Internet Explorer 6.</p>
              <p>However, as Insto is a hosted service you don't need to worry about any of this and instead can focus on creating amazing applications.</p>
              
            </div>

            <div class="span4">
              <h3>What can I do?</h3>
              <p>The purpose of Insto is to give you the power to add real-time functionality to your applications.</p>
              <p>Whether this means updating graphs and charts in real-time, connecting users in an online game, creating presentation software, pushing high quality leads to your sales team or simply creating a chat service... Insto can do it.</p>
            </div>

          </div>
          
          <div class="row-fluid"> 
            <div class="span4">
              <h3>Why should you care?</h3>
              <p>We believe that developers should be concentrating on creating exciting applications, not managing complicated systems or infrastructure.</p>
              <p>Aside from being <b>powerful</b>, <b>flexible</b> and a <b>very simple</b> way to implement real-time functionality into your application, Insto is also extremely scalable.</p>
              <p>And because we handle all the heavy lifting and logistics, you don't have to worry about anything and can be up and running in minutes.</p>
            </div>

            <div class="span8">
              <h3>Show me.</h3>
              <p>Simply include our Javascript library, define your user and connect! You are now ready to use Insto, check out some of our demos below.</p>
              <table class='table table-bordered table-striped'>
              	<tr>
              		<td><a href='/chat'>Chat</a></td>
              		<td>The quintessential real-time system. Get your first taste of Insto here.</td>
              	</tr>
              	<tr>
              		<td><a href='/analytics'>Analytics</a></td>
              		<td>Use Insto to monitor the users on your site, here we track what browser each user is using in real-time.</td>
              	</tr>
              	<tr>
              		<td><a href='/ui'>UI Sync</a></td>
              		<td>Synchronise a shared UI between all of your users.</td>
              	</tr>
              </table>
            </div>

          </div> 
              
        </div>
      </div>
    </div>
  
<?
  require_once('includes/footer.php');  
?>
