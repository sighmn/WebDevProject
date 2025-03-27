<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$host="localhost";
$user="root";
$pass="";
$db="test";

$conn=new mysqli($host,$user,$pass,$db);

$First_Name = $_POST["First_Name"];
$Last_Name = $_POST["Last_Name"];


  $sql = "INSERT INTO `username` (`First_Name`, `Last_Name`)
  VALUES ('$First_Name','$Last_Name')";



if ($conn->query($sql) == TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

}
?>