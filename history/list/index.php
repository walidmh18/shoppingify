<!DOCTYPE html>
<html lang="en">

<?php

include('../../components/connection.php');

$id = $_GET['i'];

$sql = "SELECT * FROM lists WHERE id = $id";
$res = mysqli_query($con, $sql);

$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
function includeHead($t){
   include('../../components/head.php'); 
}
includeHead($row['list_name']);


?>



<link rel="stylesheet" href="../../components/rightSideMenu.css">

<body>

   <div class="container" style="display: flex; position:relative;">


      <?php
      include('../../components/leftMenu.php')
      ?>
      

      <div class="body">

         <?php



         $username = $row['username'];
         $list = $row['list_name'];
         $items = json_decode($row['contents']);
         $time_created = $row['time_created'];
         $time_edited = $row['last_edited_time'];

         $condition = $row['cond'];

         ?>

         <a href="../" class="backBtn"><i class="fa-solid fa-chevron-left"></i> Go back</a>

         <h1 style="text-transform:capitalize;"><?php echo $list; ?> <span>by: @<?php echo $username; ?></span></h1>

         <?php
         if (isset($_GET['success'])) {
            echo '<p class="successMsg">' . $_GET['success'] . '</p>';
         }
         ?>

         <?php
         if (isset($_GET['error'])) {
            echo '<p class="errorMsg">' . $_GET['error'] . '</p>';
         }
         ?>
         <div class="timeCreated">
            <p><i class="fa-solid fa-calendar"></i> Time Created: <?php echo $time_created; ?></p>

         </div>

         <div class="lastTimeEdited">
            <p><i class="fa-solid fa-calendar"></i> Last time Edited: <?php echo $time_edited; ?></p>

         </div>


         <div class="itemsContainer">
            <?php
            $categories = array();
            foreach ($items as $x => $y) {
               $sql = "SELECT category FROM items WHERE name='$x'";
               $result = mysqli_query($con, $sql);
               while ($categoryRow = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                  array_push($categories, $categoryRow['category']);
               }
            }
            $categories = array_unique($categories);
            foreach ($categories as $x => $y) {
               echo '   <div class="category">
      <h2 class="categoryName">' . $y . '</h2>
      <div class="categoryItems">';
               foreach ($items as $a => $b) {
                  $sql = "SELECT * FROM items WHERE name='$a' AND category='$y'";
                  $r = mysqli_query($con, $sql);
                  while ($itemRow = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                     echo '<div class="item">
            <p> ' . $a . ' </p><span>' . $b . ' pcs</span>
         </div>';
                  }
               }
               echo '</div>
      </div>';
            }
            $sql = "SELECT";
            ?>



            <form method="post" action="../../components/changeCondition.php" class="actionBtns">
               <input type="hidden" name="list" value="<?php echo $id; ?>">
               <input type="hidden" name="newCond" value="completed">
               <button type="cancel" onclick="showPopup()" class="cancel">Cancel</button>
               <button type="submit" name="submit" class="completeBtn">Complete</button>
            </form>

         </div>
      </div>


      <?php
      include('../../components/rightMenu.php')
      ?>
      <div class="popup">
         <div class="container">
            <p class="text">Are you sure that you want to cancel this list?</p>

            <form method="post" action="../../components/changeCondition.php" class="actions" style="position: unset;">
               <input type="hidden" name="list" value="<?php echo $id; ?>">
               <input type="hidden" name="newCond" value="canceled">
               <button type="cancel" onclick="hidePopup()" class="noBtn">No</button>
               <button type="submit" name="submit" class="yesBtn">Yes</button>
            </form>
         </div>
      </div>
   </div>


</body>

</html>