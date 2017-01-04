


<?php
// header('Access-Control-Allow-Origin: *');
// what needs to be passed : class of the individual then type of marks (final,midYear,classTest1,classTest2 or classTest3)
header('Content-Type: application/json');
$output = array();

$conn = pg_connect("host=localhost port=5432 dbname=sample_db user=postgres  password=''");
echo $POST['markstype'];
echo $POST['class'];
$class= $POST['class'];
$marksType=$POST['markstype'];

if (!$conn) {
  echo "An error occurred1.\n";
  exit;
}
//
$student_id='1000';
$result = pg_query($conn, "select * FROM Marks1Final where student_id = $student_id");
$i = 0;
$fieldName=array();

if (!$result) {
  echo "An error occurred2.\n";
  exit;
}
$output2 = array();
$number_count =1;

while ($row = pg_fetch_row($result)) {
  while ($i < pg_num_fields($result)-1)
  {
  	$i = $i + 1;
    $fieldName = pg_field_name($result, $i);
    $output2[]=array($fieldName =>$row[$i]);
    // $output2[]=array(subject_name=>$fieldName);
  }
}

$output=(object) array('data'=>$output2);
echo json_encode($output2);

?>
