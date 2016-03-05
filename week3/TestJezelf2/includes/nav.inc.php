<?php
  if( !isset($_SESSION["loggedin"]) ) {
    $message = '<li><a href="login.php">Log in om een bericht te posten</a></li>';
  } else {
    $message = '<li>Welkom terug '.$_SESSION['naam'].'</li>';
    $message .= '<li><a href="post.php">Bericht posten</a></li>';
    $message .= '<li><a href="index.php">Berichten</a></li>';
    $message .='<li><a href="logout.php">Uitloggen</a></li>';
  }
?>
<nav>
  <ul>
    <?php echo $message ?>
  </ul>
</nav>