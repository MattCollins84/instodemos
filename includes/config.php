<?  
  session_start();
  date_default_timezone_set("Europe/London");
  global $config;

	//overall settings array
	$settings = array();
	
	// dev domain
	$domain['domain'] = array("insto.mattcollins.com");
	$domain['api_key'] = "key";
	$domain['insto_host'] = "http://localhost:3000";
	$settings[] = $domain;
	
	// insto domain
	$domain['domain'] = array("insto.co.uk");
	$domain['api_key'] = "insto";
	$domain['insto_host'] = "http://api.insto.co.uk:3000";
	$settings[] = $domain;
	
	// strikesandgutters domain
	$domain['domain'] = array("strikesandgutters.com");
	$domain['api_key'] = "strikes";
	$domain['insto_host'] = "http://ec2-176-34-91-164.eu-west-1.compute.amazonaws.com:3000";
	$settings[] = $domain;
	
	// find which config we need
	foreach ($settings as $s) {
		
		if (in_array($_SERVER['HTTP_HOST'], $s['domain'])) {
			$config = $s;
			break;
		}
		
	}
?>
