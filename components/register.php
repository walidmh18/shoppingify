<?php 
include("./connection.php");
$username = $_POST['username'];
$p1=$_POST['password'];
$p2=$_POST['passwordCon'];

$sql = "SELECT * FROM users WHERE username='$username'";
$res = mysqli_query($con,$sql);

if (mysqli_num_rows($res) == 0) {
   if ($p1 == $p2) {
      $sql = "INSERT INTO users (username,password) VALUES ('$username','$p1')";
      $res = mysqli_query($con,$sql);
      header("Location:../login?success=Account created successfully");
   } else {
      header("Location:../register?error=Wrong password match");
   }
} else{
   header("Location:../register?error=This username has already been used");
}



?>