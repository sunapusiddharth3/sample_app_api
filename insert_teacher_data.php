


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
$id_gen = 1000;
$i=0;

$random_names = array("Bebe Sollars","Michell Kelson","Calvin Focht ","Jacklyn Mangino","Ebony Dinan  ","Agustin Calhoon","Carlene Cromwell","Teofila Pixler  ","Donnie Ladue  ","Julienne Hise  ","Marissa Suttles ","Elyse Rish  ","Camellia Gaskell ","Ingrid Bjerke  ","Natividad Tickle","Bernadette Larry ","Wanda Tarango  ","Carleen Doctor  ","Joeann Hazelton  ","Cuc Job  ","Laurena Ambriz  ","Merissa Carew  ");
// "Francie Ascher","Juliette Haver  ","Artie Chewning ","Shelli Molino ","Ayana Ines  ","Herschel Herter ","Sumiko Roney  ","Marg Antley  ","Dierdre Upright  ","Georgiana Margulies ","Ramonita Acheson  ","Han Hentz  ","Hermina Mccaslin ");
$level = 1;
$random_level ="";

while($i<count($random_names)){

  if($level <= 10){
    $random_level = "P";
  }
  if($level >10 && $level <= 20){
    $random_level = "SS";
  }
  if($level >20 && $level <= 30){
    $random_level = "S";
  }
  $level ++;
  $rand_no= mt_rand (10,100);
  $random_date = date("Y-m-d H:i:s",$rand_no);
  $random_name = $random_names[$i];
    $query = " insert into teachers values('".$rand_no."','".$random_date."',NULL,'".$random_name."',1,'".$random_level."')";
    $result = pg_query($query);
    if (!$result) {
            $errormessage = pg_last_error();
            echo "Error with query: " . $errormessage;
            exit();
        }
        printf ("These values were inserted into the database - %s", $rand_no);
    // echo "$rand_no";
    // echo "--";
    // echo "$random_date";
    // echo "--";
    // echo "$random_name";
    // echo "--";
    // echo "$random_level";
    // echo "--";
    // echo "<br />";
  $i++;
}

// $result = pg_query($conn, "SELECT * FROM attendance");
// if (!$result) {
//   echo "An error occurred2.\n";
//   exit;
// }
// $output = array();
// $output2 = array();
// $number_count =1;
// while ($row = pg_fetch_row($result)) {
//   // echo "uid: ";
//   $output2[]=(object)array('id'=>$row[0],'uid'=>$row[0],'name'=>$row[1],'join_date'=>$row[2],'leave_date'=>$row[3],'designation'=>$row[4]);
// $number_count++;
//   // echo "<br />\n";
// }
// $output=(object) array('data'=>$output2);
// echo json_encode($output2);

?>
