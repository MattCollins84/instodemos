<?
require_once('includes/config.php');
if (!function_exists('json_encode'))
{
  function json_encode($a=false)
  {
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a))
    {
      if (is_float($a))
      {
        // Always use "." for floats.
        return floatval(str_replace(",", ".", strval($a)));
      }

      if (is_string($a))
      {
        static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
        return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
      }
      else
        return $a;
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a))
    {
      if (key($a) !== $i)
      {
        $isList = false;
        break;
      }
    }
    $result = array();
    if ($isList)
    {
      foreach ($a as $v) $result[] = json_encode($v);
      return '[' . join(',', $result) . ']';
    }
    else
    {
      foreach ($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
      return '{' . join(',', $result) . '}';
    }
  }
}

if ( !function_exists('json_decode') ){ 
  function json_decode($json) 
  {  
      // Author: walidator.info 2009 
      $comment = false; 
      $out = '$x='; 

      for ($i=0; $i<strlen($json); $i++) 
      { 
          if (!$comment) 
          { 
              if ($json[$i] == '{' || $json[$i] == '[')        $out .= ' array('; 
              else if ($json[$i] == '}' || $json[$i] == ']')    $out .= ')'; 
              else if ($json[$i] == ':')    $out .= '=>'; 
              else                         $out .= $json[$i];            
          } 
          else $out .= $json[$i]; 
          if ($json[$i] == '"')    $comment = !$comment; 
      } 
      //eval($out . ';'); 
      return $x; 
  }  
}

function getChartData($key, $from=false, $to=false) {
  
  global $config;
  
  if (!$from) {
    $from = date("Y-m-d", strtotime("-1 month"));
    $to = date("Y-m-d");
  }
  
  $url = ($config['insto_host']?$config['insto_host']:"http://api.insto.co.uk:3000")."/usage/".$key."/messages?from=".$from."&to=".$to;

  // create a new cURL resource
  $ch = curl_init();

  // set URL and other appropriate options
  curl_setopt($ch, CURLOPT_URL, $url);

  // options
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


  // grab URL and pass it to the browser
  $response = json_decode(curl_exec($ch), true);
  $response = $response['msg'];
  $info = curl_getinfo($ch);

  // close cURL resource, and free up system resources
  curl_close($ch);

  // build up graph data
  $data = array(array("Messages", "Messages"));
	$data[] = array("", 0);
  foreach ($response as $day) {
    $r = array(strval($day['key'][3])."/".strval($day['key'][2]), intval($day['value']));
    $data[] = $r;
  }
  $data[] = array("", 0);
  
  return $data;
}
?>
