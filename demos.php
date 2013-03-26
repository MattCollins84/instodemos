<?
  $demosActive = true;
  $title = "Demos";
  require_once('includes/header.php');
?>

    <!-- demos -->
    <div class="row-fluid section section-last" id="features">
      <div class="container"> 

        <div class="explain">
          <h2>DEMOS</h2>
          <p class="intro">What can you do? Let us show you.</p>
          <div class="row-fluid"> 
            <div class="span4">
              <h3>Online Chat</h3>
              <p>Perhaps the first thing anyone tries when attempting real-time applications is chat. It is the quintessential real-time application.</p>
              <p>We show you a simple example of how you could create a real-time chat application for your project.</p>
              <p><a href='/chat' class='btn btn-success'>View demo</a></p>
            </div>

            <div class="span4">
              <h3>Analytics</h3>
              <p>Collect information on your users as they move around your site and display them in a fancy-pants real-time reporting suite.</p>
              <p>We've not quite done that for you, but this demo will get you on your way...</p>
              <p><a href='/analytics' class='btn btn-success'>View demo</a></p>
            </div>

            <div class="span4">
              <h3>UI Synchronisation</h3>
              <p>You can use Insto to sync your applications interface so that all users are seeing the same thing. This could be used for reports, dashboards, presentations or just for fun!</p>
              <p>Here we show how to mess with the colours your users see...</p>
              <p><a href='/ui' class='btn btn-success'>View demo</a></p>
            </div>

          </div> 
          
          <div class="row-fluid"> 
            <div class="span4">
              <h3>Social Media</h3>
              <p>This demo is a bit different. We have created another app that monitors the <a href='https://dev.twitter.com/docs/streaming-apis' target='_blank'>Twitter streaming API</a> for mentions of Insto, and creates a cool effect whenever someone tweets about us!</p>
              <p>Thanks to some clever Javascript that we borrowed from <a href='http://zgrossbart.github.com/Dandelion/' target='_blank'>here</a>.</p>
              <p><a href='/tweet' class='btn btn-success'>View demo</a></p>
            </div>

          </div> 
              
        </div>
      </div>
    </div>
  
<?
  require_once('includes/footer.php');  
?>
