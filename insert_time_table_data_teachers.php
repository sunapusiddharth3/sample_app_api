


<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$output = array();

$conn = pg_connect("host=localhost port=5432 dbname=sample_db user=postgres  password=''");
//
if (!$conn) {
  echo "An error occurred1.\n";
  exit;
}
$result = pg_query($conn, "SELECT * FROM teachers");
// $count=0;
// $teachers_id= array();
$primary_teacher = array();
$secondary_teacher = array();
$senior_secondary_teacher = array();
if (!$result) {
  echo "An error occurred2.\n";
  exit;
}else{
  while ($row = pg_fetch_assoc($result)) {
    // $count++;
    // array_push($teachers_id,$row['uid']);
    // print_r($row);
    if(trim($row['teacher_level']) === 'SS'){
      // echo $row['uid'];exit;
      array_push($primary_teacher,$row['uid']);
    }else if(trim($row['teacher_level']) === 'S'){
      array_push($secondary_teacher,$row['uid']);
    }else if(trim($row['teacher_level']) === 'P'){
      array_push($senior_secondary_teacher,$row['uid']);
    }
  }
}
// print_r($primary_teacher);
// print_r($secondary_teacher);
// print_r($senior_secondary_teacher);
$days = ['mon','tue','wed','thu','fri','sat'];
// foreach($primary_teacher as $k=>$v){
//   foreach($days as $dK=>$dV){
//     $temp_var =$v.$dV;
//     $temp_var = str_replace(' ','',$temp_var);
//     $result2 = pg_query($conn, "insert into teacher_time_table (id) values ('$temp_var')");
//   }
// }
//
// foreach($secondary_teacher as $k=>$v){
//   foreach($days as $dK=>$dV){
//     $temp_var =$v.$dV;
//     $temp_var = str_replace(' ','',$temp_var);
//     $result2 = pg_query($conn, "insert into teacher_time_table (id) values ('$temp_var')");
//   }
// }
//
// foreach($senior_secondary_teacher as $k=>$v){
//   foreach($days as $dK=>$dV){
//     $temp_var =$v.$dV;
//     $temp_var = str_replace(' ','',$temp_var);
//     $result2 = pg_query($conn, "insert into teacher_time_table (id) values ('$temp_var')");
//   }
// }
// exit;
$primary_sub = array();
$secondary_sub = array();
$senior_secondary_sub = array();
$count_prim = 0;
$count_second = 0;
$count_seni_second = 0;
$result2 = pg_query($conn, "SELECT * FROM subject_table");
while ($row2 = pg_fetch_assoc($result2)) {
  // print_r($row2[subject_id][0]);
  if($row2[subject_id][0] == 'P'){
    array_push($primary_sub,$row2['subject_id']);
    $count_prim++;
  }else if(substr($row2[subject_id],0,2) == 'Ss'){
    array_push($secondary_sub,$row2['subject_id']);
    $count_second++;
  }else if(substr($row2[subject_id],0,2) == 'SS'){
    array_push($senior_secondary_sub,$row2['subject_id']);
    $count_seni_second++;
  }
}


// print_r($primary_sub);
// print_r($secondary_sub);
// print_r($senior_secondary_sub);

// above code was for inserting data into the table subject_table for teachers
//below code will be for randomly inserting classes in time_table for teachers - teacher_time_table
// P (1-5) S (5-10) SS(10-12)  each class will have 3 sections
$p_classes = array();
$s_classes = array();
$ss_classes = array();
// $total_p_class = 5;
// $total_s_class = ;
// $total_ss_class = 5;
$section_a = "a";
$section_b = "b";
$section_c = "c";
$i=1;
while($i<=12){
 if($i<=5){
     $temp_a = $i.$section_a;
     $temp_b = $i.$section_b;
     $temp_c = $i.$section_c;
     array_push($p_classes,$temp_a);
     array_push($p_classes,$temp_b);
     array_push($p_classes,$temp_c);
 }else if($i<=10){
   $temp_a = $i.$section_a;
   $temp_b = $i.$section_b;
   $temp_c = $i.$section_c;
   array_push($s_classes,$temp_a);
   array_push($s_classes,$temp_b);
   array_push($s_classes,$temp_c);
 }else{
   $temp_a = $i.$section_a;
   $temp_b = $i.$section_b;
   $temp_c = $i.$section_c;
   array_push($ss_classes,$temp_a);
   array_push($ss_classes,$temp_b);
   array_push($ss_classes,$temp_c);
 }
 $i++;
}
// print_r($p_classes);
// print_r($s_classes);
// print_r($ss_classes);
// exit;
$p_ids = array();
$s_ids = array();
$ss_ids = array();
$days = ['mon','tue','wed','thu','fri','sat'];
foreach($primary_teacher as $k=>$v){
  foreach($days as $k2=>$v2){
      $temp_var = $v.$v2;
      array_push($p_ids,str_replace(' ','',$temp_var));
  }
}
foreach($secondary_teacher as $k=>$v){
  foreach($days as $k2=>$v2){
      $temp_var = $v.$v2;
      array_push($s_ids,str_replace(' ','',$temp_var));
  }
}
foreach($senior_secondary_teacher as $k=>$v){
  foreach($days as $k2=>$v2){
      $temp_var = $v.$v2;
      array_push($ss_ids,str_replace(' ','',$temp_var));
  }
}
$time_slots = ['time_slot1','time_slot2','time_slot3','time_slot4','time_slot5','time_slot6','time_slot7','time_slot8'];
print_r($p_ids);
// print_r($p_classes);
print_r($s_ids);
// print_r($s_classes);
print_r($ss_ids);
// print_r($ss_classes);
for($i2=0;$i2<=count($p_ids);$i2++){

  for($j2=0;$j2<=7;$j2++){
    $str2 = "update teacher_time_table set $time_slots[$j2] = "."'$p_classes[$j2]'"." where id = "."'$p_ids[$i2]'";
      print_r($str2);echo "<br />";
      $query2 = pg_query($conn, $str2);
      $result2 = pg_query($query2);
      // if (!$result2) {
      //         $errormessage = pg_last_error();
      //         echo "Error with query: " . $errormessage;
      //         exit();
      //     }
  }
}

for($i2=0;$i2<=count($s_ids);$i2++){

  for($j2=0;$j2<=7;$j2++){
    $str2 = "update teacher_time_table set $time_slots[$j2] = "."'$s_classes[$j2]'"." where id = "."'$s_ids[$i2]'";
      print_r($str2);echo "<br />";
      $query2 = pg_query($conn, $str2);
      $result2 = pg_query($query2);
      // if (!$result2) {
      //         $errormessage = pg_last_error();
      //         echo "Error with query: " . $errormessage;
      //         exit();
      //     }
  }
}

for($i2=0;$i2<=count($ss_ids);$i2++){

  for($j2=0;$j2<=7;$j2++){
    $str2 = "update teacher_time_table set $time_slots[$j2] = "."'$ss_classes[$j2]'"." where id = "."'$ss_ids[$i2]'";
      print_r($str2);echo "<br />";
      $query2 = pg_query($conn, $str2);
      $result2 = pg_query($query2);
      // if (!$result2) {
      //         $errormessage = pg_last_error();
      //         echo "Error with query: " . $errormessage;
      //         exit();
      //     }
  }
}

// $query3 = " insert into teachers values('".$rand_no."','".$random_date."',NULL,'".$random_name."',1,'".$random_level."')";
// $str_new = "update teacher_time_table set (time_slot1) = ('sid') where id = '77wed'";
// $str_new = pg_query($conn, "SELECT * FROM subject_table");
// print_r($str_new);exit;
// $query3 = pg_query($conn, $str_new);

// $result3 = pg_query($query3);
// if (!$result3) {
        // $errormessage = pg_last_error();
        // echo "Error/ with query: " . $errormessage;
        // exit();
    // }


?>
