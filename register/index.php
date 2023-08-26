<?php
function includeHead($t)
{
   include('../components/head.php');
}
includeHead('Register');
?>




<body>
   <div class="container">

      <form action="../components/register.php" method="post">
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
         <h1>Register to <span>Shoppingify</span> and discover a world of modern shopping.</h1>
         <label for="username">Username</label>
         <input type="text" name="username" id="username" placeholder="Enter your username" required>
         <label for="password">Password</label>
         <input type="password" name="password" id="password" placeholder="Enter your Password" required>
         <label for="passwordCon">Confirm Password</label>
         <input type="password" name="passwordCon" id="passwordCon" placeholder="Confirm your Password" required>
         <div class="buttonsContainer">
            <button type="submit" class="registerBtn">Register</button>
            <a href="../index.php">Go back</a>
         </div>
         <p class="loginAction">You already have an account? <a href="../login">Login NOW</a></p>
      </form>


   </div>
</body>

</html>