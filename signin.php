<?
  $signinActive = true;
  $title = "Sign in";
  require_once('includes/header.php');
?>
    
    <!-- features -->
    <div class="row-fluid section section-last" id="features">
      <div class="container"> 

        <div class="explain">
          <p class="intro">Welcome back.</p>
          <div class="row-fluid"> 
            <div class="span4">
              <h3>Personalised Dashboard</h3>
              <p>Signing in gives you access to your own personalised dashboard, where you can find all the infomation you need to get started with Insto, as well as monitor connections and usage.</p>
              <p>Keep checking back as we are adding new features all the time!</p>
              
              <h3>Feedback</h3>
              <p>The purpose of running an open beta is to get feedback from the users of Insto to improve and tweak the system, so we may contact you from time to time.</p>
              <p>Get in touch <a href='/contact'>here</a>.</p>
            </div>

            <div class="span8">
              <h3>Sign in</h3>
              
              <form class="form-horizontal" id='signin-form' onsubmit='return signin();'>
                
                <div class="control-group" id='email-group'>
                  <label class="control-label" for="email">Email</label>
                  <div class="controls">
                    <input type="text" id="email" name='email' placeholder="Email">
                    <span class="help-inline hidden">You must provide your Email address</span>
                  </div>
                </div>
                
                <div class="control-group" id='password-group'>
                  <label class="control-label" for="password">Password</label>
                  <div class="controls">
                    <input class='mb' type="password" id="password" name='password' placeholder="Password">
                    <span class="help-inline hidden">You must provide your password</span><br />
                  </div>
                </div>
                
                <div id='fail' class='alert alert-error hidden'>
                  <p>Incorrect email/password combination</p>
                </div>
                
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Sign-in!</button>
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
