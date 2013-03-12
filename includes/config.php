<?  
  session_start();
  date_default_timezone_set("Europe/London");
  global $config;
	
	$thedomain = str_replace("www.", "", $_SERVER['HTTP_HOST']);

	//overall settings array
	$settings = array();
	
	// dev domain
	$domain['domain'] = array("insto.mattcollins.com");
	$domain['api_key'] = "98e4bbcec97a36cb591f6d3da62a2754";
	$domain['insto_host'] = "http://localhost:3000";
	$settings[] = $domain;
	
	// insto domain
	$domain['domain'] = array("insto.co.uk");
	$domain['api_key'] = "98e4bbcec97a36cb591f6d3da62a2754";
	$domain['insto_host'] = "";
	$settings[] = $domain;
	
	// find which config we need
	foreach ($settings as $s) {
		
		if (in_array($thedomain, $s['domain'])) {
			$config = $s;
			break;
		}
		
	}
?>
