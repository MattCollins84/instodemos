<?

$name = $_POST['name'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$hostname = $_POST['hostname'];
$instohost = $_POST['instohost'];

$data = array();
$data['name'] = $name;
$data['email'] = $email;
$data['password'] = $password;
$data['hostname'] = $hostname;

// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $instohost."/user/create?".http_build_query($data));

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

echo json_encode($response);

?>
