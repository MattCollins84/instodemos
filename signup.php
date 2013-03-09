<?
  $signupActive = true;
  require_once('includes/header.php');
?>
    
    <!-- features -->
    <div class="row-fluid section section-last" id="features">
      <div class="container"> 

        <div class="explain">
          <p class="intro">Join the Insto revolution.</p>
          <div class="row-fluid"> 
            <div class="span4">
              <h3>Open Beta</h3>
              <p>Insto is currently in an open beta. This means you can sign up for free and start developing your apps.</p>
              <p>Once signed up you will be able to view your usage statistics and leave feedback from your personalised dashboard.</p>
              
              <h3>Feedback</h3>
              <p>The purpose of running an open beta is to get feedback from the users of Insto to improve and tweak the system, so we may contact you from time to time.</p>
              
            </div>

            <div class="span8">
              <h3>Sign up</h3>
              
              <form class="form-horizontal" id='signup-form'>
                
                <div class="control-group" id='name-group'>
                  <label class="control-label" for="email">Name</label>
                  <div class="controls">
                    <input type="text" id="name" name='name' placeholder="Name">
                    <span class="help-inline hidden">You must provide a name</span>
                  </div>
                </div>
                
                <div class="control-group" id='email-group'>
                  <label class="control-label" for="email">Email</label>
                  <div class="controls">
                    <input type="text" id="email" name='email' placeholder="Email">
                    <span class="help-inline hidden">You must provide a valid Email address</span>
                  </div>
                </div>
                
                <div class="control-group" id='password-group'>
                  <label class="control-label" for="password">Password</label>
                  <div class="controls mb">
                    <input class='mb' type="password" id="password" name='password' placeholder="Password">
                    <span class="help-inline hidden">You must provide two matching passwords</span>
                  </div>
                  <div class="controls">
                    <input type="password" id="confirm" name='confirm' placeholder="Confirm">
                    <span class="help-inline hidden">of at least six characters</span>
                  </div>
                </div>
                
                <div class="control-group" id='hostname-group'>
                  <label class="control-label" for="password">Hostname</label>
                  <div class="controls">
                    <div class="input-prepend">
                      <span class="add-on">http://</span>
                      <input id="hostname" name='hostname' type="text" placeholder="yourwebsite.com">
                    </div>
                    <span class="help-inline hidden">You must provide a hostname</span>
                    <span class="help-block">The domain of the website that will be using Insto.<br />Please don't include a leading WWW</span>
                  </div>
                </div>
                
                <div class="control-group" id='devhostname-group'>
                  <label class="control-label" for="password">Development Hostname</label>
                  <div class="controls">
                    <div class="input-prepend">
                      <span class="add-on">http://</span>
                      <input id="devhostname" name='devhostname' type="text" placeholder="dev.yourwebsite.com">
                    </div>
                    <span class="help-block">Optional development domain.</span>
                  </div>
                </div>
                
                <div id='fail' class='alert alert-error hidden'>
                
                </div>
                
                <div class="form-actions">
                  <button type="button" onclick='signup();' class="btn btn-primary">Sign-up!</button>
                  <input type='hidden' name='instohost' id='instohost' value='<?=($config['insto_host']?$config['insto_host']:"http://api.insto.co.uk:3000");?>' />
                </div>
              </form>
            
            </div>

          </div> 
              
        </div>
      </div>
    </div>
  
<?
  require_once('includes/footer.php');  
?>
