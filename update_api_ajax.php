<?
session_start();
require_once('includes/functions.php');

$id = $_POST['id'];
$hostname = $_POST['hostname'];
$devhostname = $_POST['development_hostname'];
$email = $_POST['email'];
$password = ($_POST['password']?md5($_POST['password']):false);

$instohost = ($_SESSION['config']['insto_host']?$_SESSION['config']['insto_host']:"https://api.insto.co.uk:3000");

// find the matching doc
foreach ($_SESSION['user']['docs'] as $doc_key => $doc) {
  if ($doc['_id'] == $id) {
    $found = true;
    break;
  }
}

if ($found) {

  $doc['hostname'] = $hostname;
  $doc['development_hostname'] = $devhostname;
  $doc['email'] = $email;
  
  if ($password) {
    $doc['password'] = $password;
  }
  
  // create a new cURL resource
  $ch = curl_init();

  // set URL and other appropriate options
  curl_setopt($ch, CURLOPT_URL, $instohost."/user/update?".http_build_query($doc));

  // options
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


  // grab URL and pass it to the browser
  $response = curl_exec($ch);
  $info = curl_getinfo($ch);

  // close cURL resource, and free up system resources
  curl_close($ch);

  $r = json_decode($response, true);
  $_SESSION['user']['docs'][$doc_key] = $r['data']['user'];
  echo json_encode($response);
}

else {
  echo json_encode(array("success" => false, "error" => "Matching key not found"));
}
?>
