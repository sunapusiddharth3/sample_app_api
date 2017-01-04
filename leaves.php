


<?php
// header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$output = array();

$conn = pg_connect("host=localhost port=5432 dbname=sample_db user=postgres  password=''");

if (!$conn) {
  echo "An error occurred1.\n";
  exit;
}

$result = pg_query($conn, "SELECT * FROM leave");
if (!$result) {
  echo "An error occurred2.\n";
  exit;
}
// $output = array();
$output2 = array();
$number_count =1;
while ($row = pg_fetch_row($result)) {
  // echo "uid: ";
  $output2[]=(object)array('id'=>$row[0],'uid'=>$row[0],'name'=>$row[1],'type'=>$row[2],'leave_allocated'=>$row[3],'leave_left'=>$row[4],
  'leave_start_date'=>$row[5],'leave_end_date'=>$row[6]);
$number_count++;
  // echo "<br />\n";
}
$output=(object) array('data'=>$output2);
echo json_encode($output2);

?>
