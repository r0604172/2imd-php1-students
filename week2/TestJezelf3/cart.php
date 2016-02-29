<?php
session_start();
include_once('includes/include_products.php');

if (!empty($_POST)) {
  $id = $_POST['id'];
  $id = preg_replace('#[^0-9]#i', '', $id); // alle niet integers verwijderen
  $wasFound = false; //voor check op bereeds bestaand product in sessie array
  $i = 0;

  // Indien de sessie nog niet bestaat of leeg is
  if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) < 1) {
    // nieuwe sessie aanmaken en gekozen product toevoegen
    $_SESSION["cart"] = [
      ["prod_id" => $id, "quantity" => 1]
    ];
  } else {
    foreach ($_SESSION["cart"] as $each_item) {
      // elke array doorlopen
      while (list($key, $value) = each($each_item)) {
        if ($key === "prod_id" && $value === $id) {
          // product reeds in het mandje => quantity aanpassen
          array_splice($_SESSION["cart"], $i, 1, [["prod_id" => $id, "quantity" => $each_item['quantity'] + 1]]); // array_splice verwijderd een deel van de array en vervangt het met iets anders
          $wasFound = true;
        }
      }
      $i++;
    }
    if ($wasFound === false) {
      // product nog niet aanwezig in array => nieuw product aan sessie array toevoegen
      array_push($_SESSION["cart"], ["prod_id" => $id, "quantity" => 1]);
    }
  }
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>You shopping cart</title>
  <link href="css/reset.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="css/main.css" rel="stylesheet" type="text/css" media="screen" />
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
</head>
<body>
  <a href="products.php">Continue shopping</a>
  <div class="cartList">
      <h3>Products in your cart:</h3>
      <?php include_once('includes/include_cart.php'); ?>
  </div>
</body>
</html>