<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "kaires_newsletter";
    $conn = new mysqli($host, $user, $password, $db);

$conn=new mysqli($host,$user,$password,$db);

$First_Name = $_POST['First_Name'];
$Last_Name = $_POST['Last_Name'];
$Role = $_POST['Role'];
$Email = $_POST['Email'];
$Input = $_POST['Input'];


$sql = "INSERT INTO `username` (`First_Name`, `Last_Name`) VALUES ('$First_Name', '$Last_Name')";
$sql2 = "INSERT INTO `role` (`Role`) VALUES ('$Role')";
$sql3 = "INSERT INTO `email` (`Email`) VALUES ('$Email')";
$sql4 = "INSERT INTO `inputMore` (`Input`) VALUES ('$Input')";

if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4) ){
    echo "Data successfully stored in database";
} else {
    echo "Error storing data" . mysqli_error($conn);
}
mysqli_close($conn);


}
?>