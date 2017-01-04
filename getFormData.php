<?php
$uid= $_POST["uid"];
$pass= $_POST["password"];

$conn = pg_connect("host=localhost port=5432 dbname=sample_db user=postgres  password=''");

if (!$conn) {
  echo "An error occurred1.\n";
}

$result = pg_query($conn, "SELECT uid FROM type where uid = $uid");
if (!$result) {
  echo "error no record found";
}elseif(pg_num_rows($result)){

  session_start();
  $_SESSION["uid"]=$uid;
  echo "ok";
}else{
  echo "ot found";
}
?>
