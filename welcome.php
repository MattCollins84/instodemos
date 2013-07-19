<?
  $signupActive = true;
  $title = "Welcome";
  require_once('includes/header.php');
?>
    
    <!-- features -->
    <div class="row-fluid section section-last" id="features">
      <div class="container"> 

        <div class="explain">
          <p class="intro">Welcome.</p>
          <a href='/signin' class='btn btn-center btn-large btn-success'>Sign-in &raquo;</a>
          <div class="row-fluid"> 
            
            <div class="span4">
              <h3>How to start</h3>
              <p>Now that you have successfully registered, you can begin your Insto adventure! Access your dashboard by <a href='/signin'>signing in</a> and get creating!</p>
            </div>
            
            <div class='span4'>
              
              <h3>Usage limits</h3>
              <p>There is currently no usage limits imposed on Insto users, however at some point this may become a necessity. Usage limits can be monitored via your own personalised dashboard, available when you <a href='/signin'>sign in</a>.</p>
              
            </div>
            
            <div class='span4'>
              
              <h3>Feedback</h3>
              <p>The purpose of running an open beta is to get feedback from the users of Insto to improve and tweak the system, so we may contact you from time to time.</p>
              
            </div>


          </div>
          
          <div class="row-fluid"> 
            
            <div class="span12">
              <h2>Your API key is:</h2>
              <h2><?=$_SESSION['apikey'];?></h2>
            </div>


          </div> 
              
        </div>
      </div>
    </div>
  
<?
  require_once('includes/footer.php');  
?>
