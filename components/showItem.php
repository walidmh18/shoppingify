<?php
include('../components/connection.php');
if (isset($_POST['item'])) {
   $item = $_POST['item'];
   $category = $_POST['category'];

   $sql = "SELECT * FROM items WHERE name='$item'";
   $res = mysqli_query($con, $sql);
   $row = mysqli_fetch_array($res , MYSQLI_ASSOC);

  
   $myObj = new stdClass();
   $myObj->item = $row['name'];
   $myObj->category = $row['category'];
   $myObj->image = $row['image'];
   $myObj->note = $row['note'];
   $myJSON = json_encode($myObj);
}
?>