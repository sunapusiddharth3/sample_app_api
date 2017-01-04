


<?php
// header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$output = array();

$conn = pg_connect("host=localhost port=5432 dbname=sample_db user=postgres  password=''");

if (!$conn) {
  echo "An error occurred1.\n";
  exit;
}

$result = pg_query($conn, "SELECT * FROM section_wise_time_table");
if (!$result) {
  echo "An error occurred2.\n";
  exit;
}
// $output = array();
$output2 = array();
$number_count =1;
while ($row = pg_fetch_row($result)) {
  // echo "uid: ";
  $output2[]=(object)array('id'=>$row[0],'uid'=>$row[0],'mon'=>$row[1],'tue'=>$row[2],'wed'=>$row[3],'thu'=>$row[4],
  'fri'=>$row[5]);
$number_count++;
  // echo "<br />\n";
}
$output=(object) array('data'=>$output2);
echo json_encode($output2);

?>
