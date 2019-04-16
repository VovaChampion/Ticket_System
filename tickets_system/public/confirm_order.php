<?php
require_once('lib/ticket_class.php');
require_once('lib/order_class.php');
require_once('lib/config.php');
require_once('lib/common.php');

$id = new Order();
$order_id = $id->getLastOrderId();
// var_dump($order_id);
?>

<?php include "templates/header.php"; ?>

<div class="container">
    <h1> Thank you for your order number: <?php echo $order_id; ?></h1><br>

<!-- MARK shopping cart on the top -->

    <div class="cart-red" onclick="showCart('shopping_cart');">
        <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
        <span id="itemCount">0</span>
    </div>      

<a href="index.php" class="btn btn-primary" onclick="deleteCookie();" role="button">Go to Admin page (Tickets)</a><br>
<a href="checkin.php" class="btn btn-primary" onclick="deleteCookie();" role="button">Go to Check In page</a><br>

<?php include "templates/footer.php"; ?>