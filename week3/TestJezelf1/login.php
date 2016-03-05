<?php
  function canLogin( $p_username, $p_password ) {
    include_once('includes/conf.inc.php');

    $result = $PDO->prepare("SELECT * FROM w31 WHERE email = :email");
    $result->bindValue(':email',$p_username,PDO::PARAM_STR);
    $result->execute();
    
    if($result->rowCount() == 1) { 
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $hash = $row['password'];

      if(password_verify($p_password, $hash)) {
        return true;
      } else {
        return false;
      }
    }
  }

  if( !empty( $_POST ) ) {
    if(!empty($_POST['email']) && !empty($_POST['password'])) {
      if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $username = $_POST['email'];
        $password = $_POST['password'];

        if( canLogin( $username, $password ) ) {
          session_start();
          $_SESSION['loggedin'] = "yes";

          // redirect to index.php
          header('location: index.php');
        } else {
          // gegevens niet teruggevonden in de db
          $error = "Unable to log in.";
        }
      } else {
        // Ongeldig email adres
        $error = "Invalid email address";
      }
    } else {
      // lege velden
      $error = "Fill in all fields.";
    }
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
  <section class="login-form-wrap">
    <h1>Facebook</h1>

    <?php
      if( isset($error) ) {
        echo "<p class='error'>".$error."</p>";
      }
    ?>
    <form class="login-form" method="POST" action="">
      <label>
        <input type="email" name="email" placeholder="Email">
      </label>
      <label>
        <input type="password" name="password" placeholder="Password">
      </label>
        <input type="submit" value="Login">
      </form>
    <h5><a href="register.php">Register</a></h5>
  </section>
</body>
</html>