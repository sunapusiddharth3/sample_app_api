<?php
$servername = "localhost:3306";
$username = "root";
$password = "root";
$dbname = "sample_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  echo "ERROR,";
     die("Connection failed: " . $conn->connect_error);
} else{
  $userName = $_POST['uid'];
  $userPassword = $_POST['password'];
  $sql = "select * from login_details where name='".$userName."' and password='".$userPassword."'";

  // $sql = "select * from login_details where name='admin' and password='asdf'";
  // $sql = "select * from login_details ";
  $result = mysqli_query($conn, $sql);
  // $result = $conn->query($sql);
  // $row = $result->fetch_assoc();
  // print_r($row);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        echo "SUCCESS,";
          echo "name=".$row['name'].",uid=".$row['uid'];
      }
  } else {
      echo "NOTFOUND,";
  }

  $conn->close();
}
?>
