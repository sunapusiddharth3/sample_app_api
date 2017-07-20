


<?php
// header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
// $output = array();

$conn = pg_connect("host=localhost port=5432 dbname=sample_db user=postgres  password=''");
//
if (!$conn) {
  echo "An error occurred1.\n";
  exit;
}
$result = pg_query($conn, "SELECT * FROM teachers");
$count=0;
$teachers_id= array();
if (!$result) {
  echo "An error occurred2.\n";
  exit;
}else{
  while ($row = pg_fetch_assoc($result)) {
    $count++;
    array_push($teachers_id,$row['uid']);
  }
  $days =array("mon","tue","wed","thu","fri","sat");
  $i=0;
  // print_r($days);
  // echo "<br />";
  // print_r($teachers_id);
  while($i<$count){
    $repeating = 0;
    while($repeating<6){
      $name = $teachers_id[$i].$days[$repeating];
      $name = str_replace(' ', '', $name);
      // echo "<br />";
      // insert into teachers (subjects)values("SSsub1,SSsub3,SSsub7,SSsub6");
      $query = "insert into teacher_time_table (id) values('".$name."')";
      $result = pg_query($query);
      if (!$result) {
              $errormessage = pg_last_error();
              echo "Error with query: " . $errormessage;
              
          }
          printf ("These values were inserted into the database - %s", $name);
      $repeating++;
    }
    $i++;
  }
  echo "$count";
}

?>
