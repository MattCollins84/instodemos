<?
  session_start();
  if (!isset($_SESSION['user']) || !$_SESSION['user']) {
    header("Location: /");
    exit;
  }
  
  //active tab
  if ($_GET['usage']) { $usageActive = true; }
  else if ($_GET['feedback']) { $feedbackActive = true; }
  else { $keysActive = true; }
  
  $dashboardActive = true;
  require_once('includes/header.php');
?>
    
    <!-- features -->
    <div class="row-fluid section section-last" id="features">
      <div class="container"> 
        <ul class="nav nav-tabs">
          <li <?=($keysActive?'class="active"':'');?>><a href='/dashboard/keys'>API Keys</a></li>
          <li <?=($usageActive?'class="active"':'');?>><a href='/dashboard/usage'>Usage</a></li>
          <li <?=($feedbackActive?'class="active"':'');?>><a href='/dashboard/feedback'>Feedback</a></li>
        </ul>
        <div class="explain">
          <div class="row-fluid"> 
            
            <?
            // which page to load
            if ($keysActive) { include_once('dashboard-keys.php'); }
            else if ($usageActive) { include_once('dashboard-usage.php'); }
            else if ($feedbackActive) { include_once('dashboard-feedback.php'); }
            ?>
            
          </div>
        </div>
      </div>
    </div>
  
<?
  require_once('includes/footer.php');  
?>
