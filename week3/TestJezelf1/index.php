<?php
  session_start();
  if( !isset($_SESSION["loggedin"]) ) {
    header("location: login.php");
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Facebook</title>
  <!-- LAYOUT BY ED BOND: http://codepen.io/edbond88/pen/yGjAu -->
  <link rel="stylesheet" href="css/facebook.css">
</head>
<body>
  <section class="login-form-wrap" style="height: 156px">
    <p class="message">Welcome!</p>
    <a style="color: white" href="logout.php">Logout</a>
  </section>
</body>
</html>