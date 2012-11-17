<?  
  session_start();
  global $config;
  $config = array();
  $config['api_key'] = ($_SERVER['HTTP_HOST']=="insto.mattcollins.com"?"key":"strikes");
  $config['insto_host'] = ($_SERVER['HTTP_HOST']=="insto.mattcollins.com"?"http://localhost:3000":"http://ec2-176-34-91-164.eu-west-1.compute.amazonaws.com:3000");
?>
