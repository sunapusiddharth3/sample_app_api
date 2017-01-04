


<?php
// header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$output = array();

$conn = pg_connect("host=localhost port=5432 dbname=sample_db user=postgres  password=''");

if (!$conn) {
  echo "An error occurred1.\n";
  exit;
}

$result = pg_query($conn, "SELECT * FROM time_table_dayntimewise1");
if (!$result) {
  echo "An error occurred2.\n";
  exit;
}
// $output = array();
$output2 = array();
$number_count =1;
while ($row = pg_fetch_row($result)) {
  // echo "uid: ";
  $output2[]=(object)array('id'=>$row[0],'uid'=>$row[0],'time_slot1'=>$row[1],'time_slot2'=>$row[2],'time_slot3'=>$row[3],'time_slot4'=>$row[4],
  'time_slot5'=>$row[5],'time_slot6'=>$row[6],'time_slot7'=>$row[7],'time_slot8'=>$row[8]);
$number_count++;
  // echo "<br />\n";
}
$output=(object) array('data'=>$output2);
echo json_encode($output2);

?>
