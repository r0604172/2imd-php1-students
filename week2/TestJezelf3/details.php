<?php
session_start();
if(!empty($_GET) && is_numeric($_GET['product'])) {
  $id = $_GET['product'];
  include_once('includes/include_products.php');
} else {
  header("Location: products.php");
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $products[$id]['pname'] ?></title>
  <link href="css/reset.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="css/main.css" rel="stylesheet" type="text/css" media="screen" />
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
</head>
<body>
  <a href="products.php">Back</a>
  <h1><?php echo $products[$id]['pname'] ?></h1>
  <div class="container">
    <article>
      <img src="img/<?php echo $id."-full.jpg" ?>" alt="<?php echo $products[$id]['pname']; ?>"><br>
      <span>&euro; <?php echo $products[$id]['price'] ?></span>
      <form action="cart.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="Buy now" />
      </form>
    </article>
    <div class="cartList">
      <h3>Products in your cart:</h3>
      <?php include_once('includes/include_cart.php'); ?>
  </div>
  </div>
</body>
</html>