<?php

session_start();

include('./connection.php');
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username'AND password='$password'";
$res = mysqli_query($con,$sql);


if (mysqli_num_rows($res) == 1) {
   $_SESSION['username'] = $username;
   header('Location:../items');
   exit();
   
   } else {
   $sql = "SELECT * FROM users WHERE username='$username'";
   $query = mysqli_query($con,$sql);
   if (mysqli_num_rows($query) == 0) {
      header('Location:../login?error=Username not found');
      exit();
   } else{
      header("Location:../login?error=The password you entered is Wrong, Please try again");
      exit();
   }
}
?>