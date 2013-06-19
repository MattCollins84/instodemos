<?
require_once('includes/config.php');
require_once('includes/functions.php');

//get current connections
$key = $_POST['key'];
$url = ($config['insto_host']?$config['insto_host']:"http://api.insto.co.uk:3000")."/usage/".$key."/connections";

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
$response = $response['data'];
$info = curl_getinfo($ch);

// close cURL resource, and free up system resources
curl_close($ch);

if (!$response['connections']) {
	$response['connections'] = 0;
}

?>
<div class='alert alert-success'>
  <h4 class='bbb pb'>Current connections: <span class='badge badge-success'><?=$response['connections'];?></span></h4>
  <p>This is the number of clients currently connected to Insto using this API key.</p>
</div>


<?
//get current connections
$key = $_POST['key'];

$to = date("Y-m-d");
$from = date("Y-m-d", strtotime("-1 month"));

$url = $config['insto_host']."/usage/".$key."/messages?from=".$from."&to=".$to;

$to_display = date("d/m/Y");
$from_display = date("d/m/Y", strtotime("-1 month"));

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
$data = getChartData($key);
?>
<div>
  <h3>Usage</h3>
  <p>Shows your usage from <input type='text' id='from' class='input input-small' /> to <input type='text' id='to' class='input input-small' /></p>
  <input type='hidden' id='_from' value='<?=$from;?>' onchange='updateChart();' />
  <input type='hidden' id='_to' value='<?=$to;?>' onchange='updateChart();' />
  <div class='alert alert-error hidden' id='chart-error'>
  	<h4>No data for the time period selected</h4>
  </div>
  <div id='visualization'></div>
  
</div>
<script type="text/javascript">

function drawVisualization(chartdata) {
  
  if (chartdata.length == 1) {
  	$('#chart-error').removeClass('hidden');
  	$('#visualization').addClass('hidden');
  	return false;
  }
  
  $('#chart-error').addClass('hidden');
  $('#visualization').removeClass('hidden');
  
  // Some raw data (not necessarily accurate)
  var data = google.visualization.arrayToDataTable(chartdata);

  // Create and draw the visualization.
  var ac = new google.visualization.AreaChart(document.getElementById('visualization'));
  ac.draw(data, {
    width: 440,
    height: 300,
    legend: {position: 'none'},
    chartArea: {top:20, left:40, height:'90%', width:'90%'}
  });
}

drawVisualization(<?=json_encode($data);?>);

$('#from').datepicker({ dateFormat: "dd/mm/yy", altField: "#_from", altFormat: "yy-mm-dd", onSelect: function(date, obj) {
            updateChart();
          }})
          .datepicker( "setDate", "<?=$from_display;?>" );
$('#to').datepicker({ dateFormat: "dd/mm/yy", altField: "#_to", altFormat: "yy-mm-dd", onSelect: function(date, obj) {
          updateChart();
        }})
        .datepicker( "setDate", "<?=$to_display;?>" );

var updateChart = function() {
  
  $.ajax({
    url: "/update_usage_chart.php",
    type: 'POST',
    data: {"key": "<?=$key;?>", from: $('#_from').val(), to: $('#_to').val()},
    dataType: 'json'
  }).done(function(data) { 
    
    
    drawVisualization(data);
    
    
  });;
  
}

</script>
