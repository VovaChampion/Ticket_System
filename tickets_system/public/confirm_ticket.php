
<!-- Submit part  -->
<?php  
if (isset($_POST['submit'])) {
    if($rows) { ?>
        <?php foreach ($rows as $row) : ?>
        <?php endforeach; ?>
       
<h3>Submit your ticket here: </h3><br>
<div class="submit_ticket">
<p><strong><?php echo escape($row['customer_name']); ?></strong> select your ticket that you want to use: <br>
    <div class="select_ticket">
        <form method="post">
            <select class="ticket" name="ticket">
                <?php foreach ($rows as $row) : ?>
                    <option value="<?php echo escape($row['id'])?>"><?php echo escape($row['name_ticket']); ?></option>
                    <?php endforeach; ?>
            </select>
            <input class="btn btn-success" type="submit" name="confirm" value="Confirm">
        </form>            
    </div>
    <?php } else { ?><br>
    <blockquote>No results found for <?php echo escape($_POST['id']); ?>.</blockquote>
<?php } 
}?> 
<?php
    if(isset($_POST['confirm']))
    {
        $id_item = $_POST['ticket'];
        $checkStatus = new Order();
        $checkIt = $checkStatus->selectOrderStatus($id_item);

        if($checkIt == "no") 
        {
            $status = new Order();
            $result = $status->updateTicketStatus($id_item);
        } else {
            echo 'Your ticket has already been used. Please, buy a new one or check out your other tickets.';
        }
    }
?> 
</div>