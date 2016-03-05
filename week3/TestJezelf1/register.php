<?php
  if(!empty($_POST)) {
    if(!empty($_POST['email']) && !empty($_POST['password'])) {
      if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['email'];
        $options = ['cost' => 12];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT,$options);

        include_once('includes/conf.inc.php');
        // check of email reeds bestaat
        $result = $PDO->prepare("SELECT email FROM w31 WHERE email= :email");
        $result->bindValue(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->rowCount() > 0) {
          $error ="Something went wrong";
        } else {
          $result = $PDO->prepare("INSERT INTO w31 (email, password) VALUES (:email, :password);");
          $result->bindValue(':email', $email, PDO::PARAM_STR);
          $result->bindValue(':password', $password, PDO::PARAM_STR);
          if( $result->execute() ) {
            session_start();
            $_SESSION['loggedin'] = "yes";
            header("Location: index.php");
            exit();
          }
        }
      } else {
        $error = "Invalid email address";
      }
    } else {
      $error ="Fill in all fields";
    }
  }
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
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
        <input type="submit" value="Register">
      </form>
  </section>
</body>
</html>