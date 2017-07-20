


<?php
// header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$output = array();

$conn = pg_connect("host=localhost port=5432 dbname=sample_db user=postgres  password=''");

if (!$conn) {
  echo "An error occurred1.\n";
  exit;
}
$encoded_url = urldecode($_SERVER["QUERY_STRING"]);
$query_params = explode("=", $_SERVER["QUERY_STRING"]);
$query_params = $query_params[1];

$encoded_url = explode("filter[",$encoded_url);
$encoded_url = explode("]",$encoded_url[1]);
$query_filter = $encoded_url[0];
if($query_filter && $query_params){
  $result = pg_query($conn, "SELECT * FROM students where $query_filter = $query_params");
  // print_r($result);exit;
}else{
  $result = pg_query($conn, "SELECT * FROM students");
}

if (!$result) {
  echo "An error occurred2.\n";
  exit;
}
// $output = array();
$output2 = array();
$number_count =1;
while ($row = pg_fetch_row($result)) {
  // echo "uid: ";
  $output2[]=(object)array('id'=>$row[0],'uid'=>$row[0],'join_date'=>$row[1],'leave_date'=>$row[2],'name'=>$row[3],'parent_uid'=>$row[4],'present_class'=>$row[5],'section'=>$row[6]);
$number_count++;
  // echo "<br />\n";
}
$output=(object) array('data'=>$output2);
echo json_encode($output2);

?>
