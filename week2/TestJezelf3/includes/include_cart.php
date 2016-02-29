<?php
// cart inhoud genereren
$cartOutput = "";
$total = 0;

if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) < 1) {
  // Indien cart leeg is
  $cartOutput = '<span class="emptyCart">Your shopping cart is empty</span>';
} else {
  // cart is niet leeg
  $i = 0;
  $cartOutput .="<table>
  <tr>
    <td>Quant.</td>
    <td>Product</td>
    <td>Unit Price</td>
    <td>Total</td>
  </tr>";

  foreach ($_SESSION["cart"] as $each_item) {
    $i++;
    $cartOutput .= "<tr>
    <td>".$each_item['quantity']."x </td>
    <td>".$products[$each_item['prod_id']]['pname']."</td>
    <td>&euro;".$products[$each_item['prod_id']]['price']."</td>
    <td>&euro;".$products[$each_item['prod_id']]['price'] * $each_item['quantity']."</td>
    </tr>";
    $total += $products[$each_item['prod_id']]['price'] * $each_item['quantity'];
  }

  $cartOutput .="<tr><td colspan='3'>Total:</td><td>&euro; ".$total."</td></tr>";
  $cartOutput .="</table>";
}
echo $cartOutput;
?>