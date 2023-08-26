<!DOCTYPE html>
<html lang="en">
<?php function includeHead($t){
   include('../components/head.php'); 
}
includeHead('Items');

session_start();
if (isset($_SESSION['username'])) {
   $username = $_SESSION['username'];
}
?>


<body>
   <div class="bodyContainer">
      <?php include('../components/leftMenu.php'); ?>
      <?php
      include('../components/connection.php');
      ?>
      <div class="body">
         <h1><span>Shoppingify</span> allows you take your shopping list wherever you go</h1>
         <div class="top">

            <input type="search" name="searchInp" id="searchInp" placeholder="search item">

            <?php
            if (!isset($_SESSION['username'])) {
               echo '<a class="loginBtn" href="../login">Login</a>';
            } else {
               echo '<a class="loginBtn" href="../components/logout.php">Logout</a>';
            }
            ?>

         </div>
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
         <div class="itemsContainer">

            <?php

            $sql = "SELECT name FROM categories";
            $res = mysqli_query($con, $sql);


            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
               echo '<div class="category">
      <p class="categoryName">' . $row['name'] . '</p>
      <div class="categoryItems">';

               $category = $row['name'];
               $sql = "SELECT * FROM items WHERE category='$category'";
               $result = mysqli_query($con, $sql);

               while ($itemRow = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                  echo '<div class="item">
         <button class="" onclick="showItem(this.innerText, this.parentElement.parentElement.previousElementSibling.innerText)">' . $itemRow['name'] . '</button>
         <button class="plusBtn" onclick="addItem(this.previousElementSibling.innerText , this.parentElement.parentElement.previousElementSibling.innerText , 1)"><i class="fa-solid fa-plus"></i></button>

      </div>';
               }

               echo '</div>
      </div>';
            }
            ?>
         </div>
      </div>


      <?php

      include('../components/rightMenu.php');
      ?>

   </div>
   
</body>

</html>