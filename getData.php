


<?php
// header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json');
$output = array();

$conn = pg_connect("host=localhost port=5432 dbname=sample_db user=postgres  password=''");

if (!$conn) {
  echo "An error occurred1.\n";
  exit;
}

$result = pg_query($conn, "SELECT uid FROM type");
if (!$result) {
  echo "An error occurred2.\n";
  exit;
}

while ($row = pg_fetch_row($result)) {
  // echo "uid: ";
  $output[] = $row[0];

  // echo "<br />\n";
}
echo json_encode($output);

?>
