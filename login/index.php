<?php
function includeHead($t){
   include('../components/head.php'); 
}
includeHead('Login');
?>


<body>
   <div class="container">
   
   <form action="../components/login.php" method="post">
   <?php
            if (isset($_GET['success'])) {
               echo '<p class="successMsg">'.$_GET['success'].'</p>';
            }
         ?>

         <?php
            if (isset($_GET['error'])) {
               echo '<p class="errorMsg">'.$_GET['error'].'</p>';
            }
         ?>
   <h1> Login to <span>Shoppingify</span> and start a shopping journey.</h1>
   <label for="username">Username</label>
   <input type="text" name="username" id="username" placeholder="Enter your username">
   <label for="password">Password</label>
   <input type="password" name="password" id="password" placeholder="Enter your Password">
   <div class="buttonsContainer">
      <button type="submit" class="loginBtn">Login</button>
      <a href="../index.php">Go back</a>
   </div>
   <p class="registerAction">You don't have an account? <a href="../register">Create one NOW</a></p>
   </form>
   

   </div>
</body>
</html>