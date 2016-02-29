<?php
session_start();
include_once('includes/include_products.php');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ritter Basses</title>
  <link href="css/reset.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="css/main.css" rel="stylesheet" type="text/css" media="screen" />
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
</head>
<body>
  <h1>Ritter Basses</h1>
  <div class="container">
    <?php foreach( $products as $key => $product ): ?> 
    <article>
      <h2><?php echo $product['pname'].' - &euro; '.$product['price']; ?></h2>
      <div class="prodPic"><?php echo '<img src="img/'.$key.'.jpg" alt="'.$product['pname'].'">'; ?></div>
      <span class="moreLink"><a href="details.php?product=<?php echo $key ?>">More info</a></span>
    </article>
    <?php endforeach; ?>
    <div class="cartList">
      <h3>Products in your cart:</h3>
      <?php include_once('includes/include_cart.php'); ?>
    </div>
  </div>
</body>
</html>