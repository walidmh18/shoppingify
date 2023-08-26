<!DOCTYPE html>
<html lang="en">
<?php
function includeHead($t){
   include('../components/head.php'); 
}
includeHead('History');

include('../components/connection.php');
session_start();

?>

<body>
   <div class="container" style="display: flex;  position:relative;">


      <?php include('../components/leftMenu.php') ?>

      <div class="body">
         <h1>Shopping history</h1>
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

         <div class="listsContainer">


            <?php
            $username = $_SESSION['username'];
            $sql = "SELECT * FROM lists WHERE username='$username'";
            $res = mysqli_query($con, $sql);
            $months = [
               'January',
               'February',
               'March',
               'April',
               'May',
               'June',
               'July',
               'August',
               'September',
               'October',
               'November',
               'December'
            ];
            $dates = array();
            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
               array_push($dates, date("Y m", strtotime($row['time_created'])));
            }
            rsort($dates);
            $dates = array_unique($dates);
            foreach ($dates as $x => $v) {
               echo '<div class="month">
            <h3>' . $months[explode(' ', $v)[1] - 1] . ' ' . explode(' ', $v)[0] . '</h3>';
               $res = mysqli_query($con, $sql);

               while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {

                  if (date("Y m", strtotime($row['time_created'])) == $v) {
                     echo '<div class="list">
                  <p class="name">' . $row['list_name'] . '</p>
                  <div class="right">
                     <p class="date"><i class="fa-solid fa-calendar"></i>  ' . $row['time_created'] . '</p>
                     <p class="condition ' . $row['cond'] . '">' . $row['cond'] . '</p>
                     <a href="./list?i=' . $row['id'] . '"><i class="fa-solid fa-chevron-right"></i></a>
                  </div>
               </div>';
                  }
               }
               echo '</div>';
            };

            ?>

         </div>
      </div>
      <?php include('../components/rightMenu.php') ?>
   </div>

</body>

</html>