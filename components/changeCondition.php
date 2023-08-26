<?php


include('./connection.php');
if (isset($_POST['list'])) {
   $id = $_POST['list'];
   $condition = $_POST['newCond'];

   $sql = "UPDATE lists SET cond='$condition' WHERE id='$id'";
   $res = mysqli_query($con , $sql);
   header('Location:../history?success=list is now '.$condition);
   exit();
} else {
   header('Location:../history?error=An error occurred, please try again.');
   exit();
}

?>