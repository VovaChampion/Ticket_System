<?php
require_once('lib/ticket_class.php');
require_once('lib/order_class.php');
require_once('lib/config.php');
require_once('lib/common.php');

$ticket = new Ticket();
$rows = $ticket->getTickets();
?>

<!-- Cookies  -->
<?php
// echo "<pre>";
    if (isset($_COOKIE['cart'])) {
        $cart_array = json_decode(stripslashes($_COOKIE['cart']),true);
        // echo '<h4>Cart</h4>';
        // var_dump($cart_array);
    }
?>

<!-- Create an order -->
<?php
if(isset($_POST['create_order'])) 
{
    $user_name = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_MAGIC_QUOTES);
    $user_email = filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL);
    
    foreach($cart_array as $key => $value) 
    {
        $ticket_id = (int)$value['id'];
        $my_array [] = $ticket_id;
    }
    var_dump($my_array);

    $stmt = new Order();
    $result = $stmt->createOrder($user_name,$user_email,$my_array);
}   

?>

<?php include "templates/header.php"; ?>

<div id="top" class="container">

<!-- MARK shopping cart on the top -->
    <a href="#top">
        <div class="cart-red" onclick="showCart('shopping_cart');">
            <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
            <span id="itemCount">0</span>
        </div>  
    </a>

<!-- Shopping cart -->
<div id="shopping_cart">
    <section class="container content-section">
        <h2 class="section-header">Shopping cart</h2>
        <div class="cart-row">
            <span class="cart-item cart-header cart-column">Title</span>
            <span class="cart-price cart-header cart-column">Price</span>
            <span class="cart-quantity cart-header cart-column">Quantity</span>
        </div>
        <div class="cart-items">
        </div>
        <div class="cart-total">
            <strong class="cart-total-title">Total</strong>
            <span class="cart-total-price">SEK 0</span>
        </div>
        <button class="btn btn-primary btn-purchase" type="button" onclick="formToggle('my_form');">CheckOut</button>   
    </section> 

<!-- Check out -->
    <form id="my_form" method="post"><br>
        <div class="input-group mb-3">
            <input type="text" name="user_name" placeholder="Your Name" required><br>
            <div class="input-group-prepend">
                <span class="input-group-text">Example</span>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="email" name="user_email" placeholder="Your Email" required>
            <div class="input-group-append">
                <span class="input-group-text">@example.com</span>
            </div>
            </div>
        <button class="btn btn-success" name="create_order" value="Submit">Submit</button>
    </form>
</div> 
<!-- Products -->
    <section class="container content-section">
        <h2 class="section-header">Tickets</h2>
        <div class="shop-items">
        <?php foreach ($rows as $row) : ?>
            <div class="shop-item">
                <span class="shop-item-title"><?php echo escape($row["name_ticket"]); ?></span>
                <span class="shop-item-description"><?php echo escape($row["description"]); ?></span>
                <img class="shop-item-image" src="<?php echo escape($row["image"]); ?>">
                <div class="shop-item-details">
                    <span class="shop-item-price"><?php echo "SEK " . escape($row["price"]); ?></span>
                    <input class="shop-item-id" type="hidden" name="id" value="<?php echo escape($row['id'])?>">
                    <input class="shop-item-qty" type="hidden" name="qty" value="1">
                    <button class="btn btn-primary shop-item-button" type="button">ADD TO CART</button>
                </div>
            </div>
            <?php endforeach; ?>
    </section>
    <p>* - The ticket is valid in any direction on the selected line 1 month from the date of purchase.</p>
</div>

<a href="index.php" class="btn btn-primary" role="button">Go to Admin page (Tickets)</a><br>
<a href="checkin.php" class="btn btn-primary" role="button">Go to Check In page</a><br>
<a href="confirm_order.php" class="btn btn-primary" role="button">Confirm page</a><br>

<?php include "templates/footer.php"; ?>