<?php
  session_start();
  if( !isset($_SESSION["loggedin"]) ) {
    header("location: index.php");
    exit();
  }
  include_once('includes/conf.inc.php');

  if(!empty($_POST)) {
    $titel = $_POST['titel'];
    $tekst = $_POST['tekst'];

    $result = $PDO->prepare("INSERT INTO posts (user_id, titel, tekst) VALUES (:user_id, :titel, :tekst);");
    $result->bindValue(':user_id', $_SESSION['loggedin'], PDO::PARAM_STR);
    $result->bindValue(':titel', $titel, PDO::PARAM_STR);
    $result->bindValue(':tekst', $tekst, PDO::PARAM_STR);
    if( $result->execute() ) {
      $feedback = '<p class="feedback">Uw bericht werd gepost.<br>Klik <a href="index.php">hier</a> om het te lezen.</p>';
    }
  }
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Post een bericht</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
  <?php include_once('includes/nav.inc.php'); ?>

  <section>
    <?php
      if ( isset($feedback)) {
        echo $feedback;
      }
    ?>
    <form action="" method="post">
      <div>
        <label for="titel">Titel</label><br>
        <input type="text" name="titel">
      </div>

      <div>
        <label for="tekst">Tekst</label><br>
        <textarea name="tekst" cols="30" rows="10"></textarea>
      </div>

      <input type="submit" value="Verzenden">
    </form>
  </section>
  
</body>
</html>