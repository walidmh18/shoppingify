<?php
session_start();
include('../components/connection.php');
if(isset($_SESSION['username'])){
   
if (isset($_POST['submit'])) {
   $list_name = $_POST['listName'];
   $username = $_SESSION['username'];
   $contents = json_encode($_POST['item']);


   $sql = "SELECT list_name FROM lists WHERE list_name = ('$list_name') and username = ('$username')";
   $res = mysqli_query($con,$sql);
   
   $sql = "SELECT list_name FROM lists WHERE list_name = ('$list_name') ";
   $res2 = mysqli_query($con,$sql);


   $count = $res->num_rows;
   $count2 = $res2->num_rows;
   if ($count == 0) {
      $time_created =  date("l, d-m-Y");
      $time_edited =  date("l, d-m-Y");
      
      $sql = "INSERT INTO lists (username,list_name,contents,time_created,last_edited_time)	 VALUES ('$username','$list_name','$contents','$time_created','$time_edited')";
      $res = mysqli_query($con,$sql);

      foreach ($_POST['item'] as $x => $y) {
         $sql = "SELECT times_added FROM items WHERE name='$x'";
         $result = mysqli_query($con,$sql);
         $row = mysqli_fetch_array($result , MYSQLI_ASSOC);
         $prevt = $row['times_added'];
         $newt = $prevt + 1;

         $sql = "UPDATE items SET times_added='$newt' WHERE name='$x'";
         $result2 = mysqli_query($con,$sql);
         
         
      }

      header('Location:../items?success=list successfully added');
      exit();
   } else if($count == 1 ){
      $time_edited =  date("l, d-m-Y");

      $sql = "UPDATE lists SET contents = '$contents' , last_edited_time = '$time_edited' WHERE username = '$username' and list_name = '$list_name'";
      $res = mysqli_query($con,$sql);
      header('Location:../items?success=list successfully updated');
      exit();

   } else {
      header('Location:../items?error=An error occurred, please try again.');
      exit();
   }

   
}

} else {
   header("Location:../login?error=You should be logged in to save a list");
   exit();
}


?>