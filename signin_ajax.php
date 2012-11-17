<?
session_start();
require_once('includes/functions.php');

$email = $_POST['email'];
$password = md5($_POST['password']);


// create a new cURL resource
$ch = curl_init();

$url = 'https://h8851143.cloudant.com/users/_design/api/_view/login?key=%5B%22'.$email.'%22,%22'.$password.'%22%5D&include_docs=true';

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $url);

// options
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPGET, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


// grab URL and pass it to the browser
$response = curl_exec($ch);
$info = curl_getinfo($ch);

$response = json_decode($response, true);

$_SESSION['user'] = array();
$output = array();
$output['url'] = $url;
$output['response'] = $response;
$output['info'] = $info;
$output['error'] = curl_error($ch);

// close cURL resource, and free up system resources
curl_close($ch);

// if we have some users
if (count($response['rows'])) {
  // create session data
  $_SESSION['user']['name'] = $response['rows'][0]['doc']['name'];
  $_SESSION['user']['email'] = $response['rows'][0]['doc']['email'];
  $_SESSION['user']['docs'] = array();
  foreach ($response['rows'] as $row) {
    $_SESSION['user']['docs'][] = $row['doc'];
  }
  
  //build return object
  $output['success'] = true;
}

// no users
else {
  $output['success'] = false;
}

echo json_encode($output);


?>
