<?
require_once('includes/config.php');
require_once('includes/functions.php');

$key = $_POST['key'];
$from = $_POST['from'];
$to = $_POST['to'];

// build up graph data
$data = getChartData($key, $from, $to);

echo json_encode($data);
?>
