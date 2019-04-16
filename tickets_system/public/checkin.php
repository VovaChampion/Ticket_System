<?php
require_once('lib/ticket_class.php');
require_once('lib/order_class.php');
require_once('lib/config.php');
require_once('lib/common.php');

$id = isset($_POST['id']) ? $_POST['id'] : '';
$order = new Order();
$rows = $order->selectOrder($id);
?>

<?php include "templates/header.php"; ?>

<div class="container">
    <h3>Check your tickets: </h3><br>

    <!-- Show order details   -->
    <?php  
    if (isset($_POST['submit'])) {
        if($rows) { ?>
            <?php foreach ($rows as $row) : ?>
            <tr>
                <td><?php //echo escape($row['id']); ?></td>
                <td><?php //echo escape($row['name_ticket']); ?></td>
                <td><?php //echo escape($row['customer_name']); ?></td>
                <td><?php //echo escape($row['used_ticket']); ?></td>
                <td><?php //echo escape($row['valid_date']); ?></td>
                <td><?php //$order->countDays($row['valid_date']); ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table><br>

        <!-- <h3>Validation: </h3> -->
        <p>Hi  <strong><?php echo escape($row['customer_name']); ?></strong> your ticket(s): <br>
            <div class="check_ticket">
                <ol><?php foreach ($rows as $row) : ?>
                    <li><strong><?php echo escape($row['name_ticket']); ?></strong>
                    <?php $order->checkTicket($row['used_ticket'],$row['valid_date']); ?></li><br>
                    <?php endforeach; ?></p></ol>
            </div>
            <?php } else { ?><br>
            <blockquote>No results found for <?php echo escape($_POST['id']); ?>.</blockquote>
        <?php } 
    }?> 

    <!-- select order -->
    <form method="post">
        <label for="id">Enter your ticket number</label>
        <input type="text" id="id" name="id"><br><br>
        <input class="btn btn-success" type="submit" name="submit" value="View Results"><br>
    </form><br>
    <!-- confirm ticket -->
    <?php include_once('confirm_ticket.php'); ?>
</div>

<a href="index.php" class="btn btn-primary" role="button">Go to Admin page (Tickets)</a><br>
<a href="product_page.php" class="btn btn-primary" role="button">Go to shop</a><br>

<?php include "templates/footer.php"; ?>