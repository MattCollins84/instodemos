<?
  $contactActive = true;
  require_once('includes/header.php');
  
  if (isset($_POST['email']) && $_POST['email']) {
  	
  	if ($_SESSION['user']) {
  		
  		$_POST['question'] .= "\n\n";
  		$_POST['question'] .= print_r($_SESSION['user'], true);
  		
  		$headers = 'From: ' . $_POST['email'] . "\r\n" .
    'Reply-To: ' . $_POST['email'] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
  		
  	}
  	
  	if(mail("support@insto.co.uk", $_POST['subject'], $_POST['question'], $headers)) {
  		$mailSent = true;
  	} else {
  		$mailSent = false;
  	}

  }
?>
    
    <!-- features -->
    <div class="row-fluid section section-last" id="features">
      <div class="container"> 

        <div class="explain">
          <p class="intro">Complain, question, or just say hi.</p>
          <div class="row-fluid"> 
            <div class="span4">
              <h3>Get in touch</h3>
              <p>Use this form to get in touch with the Insto team.</p>
              <p>We are available to answer any questions you have about Insto, including discussing any needs you have to get Insto up and running for your project.</p>
              
              <h3>Feedback</h3>
              <p>We especially welcome any feedback on your experiences with Insto.</p>
              <p>We are currently in an Open Beta phase and have a plan in place to get us where we want to be, however we are always looking to make things easier for our users and implement any new features if there is demand.</p>
              
            </div>

            <div class="span8">
              <form class="form-horizontal" id='contact-form' method='POST' action='/contact' onsubmit='return contact();'>
                
                <? if ($mailSent) { ?>
                <div class='alert alert-success '>
                	<p>Your contact request has been sent successfully, we will be in touch shortly</p>
                </div>
                <? } ?>
                
                <? if ($mailSent === false) { ?>
                <div class='alert alert-error '>
                	<p>We failed to send your request, please try again.</p>
                </div>
                <? } ?>
                
                <div class="control-group" id='name-group'>
                  <label class="control-label" for="name">Name</label>
                  <div class="controls">
                    <input type="text" id="name" name='name' placeholder="Name" value="<?=$_SESSION['user']['name'];?>" >
                    <span class="help-inline hidden">You must provide a name</span>
                  </div>
                </div>
                
                <div class="control-group" id='email-group'>
                  <label class="control-label" for="email">Email</label>
                  <div class="controls">
                    <input type="text" id="email" name='email' placeholder="Email" value="<?=$_SESSION['user']['email'];?>">
                    <span class="help-inline hidden">You must provide a valid Email address</span>
                  </div>
                </div>
                
                <div class="control-group" id='subject-group'>
                  <label class="control-label" for="subject">Subject</label>
                  <div class="controls">
                    <input type="text" id="subject" name='subject' placeholder="Subject" >
                    <span class="help-inline hidden">You must provide a subject</span>
                  </div>
                </div>
                
                <div class="control-group" id='question-group'>
                  <label class="control-label" for="subject">Your question</label>
                  <div class="controls">
                    <textarea name='question' id='question' rows="8" style="width: 70%;"></textarea>
                    <span class="help-block hidden">You must provide some text</span>
                  </div>
                </div>
                
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Send Message</button>
                  <input class='mb' type='hidden' name='instohost' id='instohost' value='<?=($config['insto_host']?$config['insto_host']:"http://api.insto.co.uk:3000");?>' />
                	<? if ($_SESSION['user']) { ?>
                	<p class='mt'>Your user details will be sent along with the information you supply above.</p>
                	<? } ?>
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
