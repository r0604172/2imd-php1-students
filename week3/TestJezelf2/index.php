<?php
  session_start();
  include_once('includes/conf.inc.php');

  if(!empty($_POST)) {
    $titel = $_POST['titel'];
    $tekst = $_POST['tekst'];

    $result = $PDO->prepare("INSERT INTO posts (titel, tekst) VALUES (:titel, :tekst);");
    $result->bindValue(':titel', $titel, PDO::PARAM_STR);
    $result->bindValue(':tekst', $tekst, PDO::PARAM_STR);
    $result->execute();
  }

  $posts ="";
  $result = $PDO->query("SELECT a.titel, a.tekst, b.naam, a.datum FROM posts AS a join users AS b ON(b.id = a.user_id) ORDER BY a.datum DESC;");
  if ( $result->execute() ) {
    if ( $result->rowCount() < 1) {
      $posts .="Nog niets gepost";
    } else {
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $posts .="<article>
        <h2>".$row['titel']."</h2>
        <div class='geschrevenDoor'>Geschreven door ".$row['naam']." op ".str_replace("-", "/", date("d-m-Y", strtotime($row['datum'])))."</div>
        <div>".$row['tekst']."</div>
        </article>";
      }
    }
  } else {
    $posts .="Kon posts niet ophalen";
  }
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <?php include_once('includes/nav.inc.php'); ?>
  <title>Blog</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">
  <section>
    <?php echo $posts; ?>
  </section>
</head>
<body>
  
</body>
</html>