<?php
  function canLogin( $p_username, $p_password ) {
    include_once('includes/conf.inc.php');

    $result = $PDO->prepare("SELECT * FROM users WHERE naam = :gebruikersnaam");
    $result->bindValue(':gebruikersnaam',$p_username,PDO::PARAM_STR);
    $result->execute();
    
    if($result->rowCount() == 1) { 
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $hash = $row['paswoord'];

      if(password_verify($p_password, $hash)) {
        session_start();
        $_SESSION['loggedin'] = $row['id'];
        $_SESSION['naam'] = $row['naam'];
        return true;
      } else {
        return false;
      }
    }
  }

  if( !empty( $_POST ) ) {
    if(!empty($_POST['gebruikersnaam']) && !empty($_POST['password'])) {
        $username = $_POST['gebruikersnaam'];
        $password = $_POST['password'];

        if( canLogin( $username, $password ) ) {
          // redirect to index.php
          header('location: index.php');
        } else {
          // gegevens niet teruggevonden in de db
          $error = "Unable to log in.";
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
  <title>Blog</title>
  <!-- LAYOUT BY ED BOND: http://codepen.io/edbond88/pen/yGjAu -->
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
  <section class="login-form-wrap">
    <h1>Blog</h1>

    <?php
      if( isset($error) ) {
        echo "<p class='error'>".$error."</p>";
      }
    ?>
    <form class="login-form" method="POST" action="">
      <label>
        <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam">
      </label>
      <label>
        <input type="password" name="password" placeholder="Password">
      </label>
        <input type="submit" value="Login">
      </form>
  </section>
</body>
</html>