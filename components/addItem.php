<?php
include('../components/connection.php');
if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $image = $_POST['image'];
   $note = $_POST['note'];
   $category = $_POST['category'];


   $sql = "INSERT INTO items (name,category,note,image) VALUES ('$name', '$category' , '$note' , '$image')";
   $result = mysqli_query($con, $sql);
   if ($result) {
      $sql = "SELECT * FROM categories WHERE name='$category'";
      $res = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

      if (!$row) {
         $sql = "INSERT INTO categories  (name) VALUES ('$category')";
         $resc = mysqli_query($con, $sql);
      } 

      header('Location:../items/index.php?success=item added successfully');
      exit();

   } else {
      header('Location:../items/index.php?error=An error occurred, Please try again.');
      exit();
   }



}