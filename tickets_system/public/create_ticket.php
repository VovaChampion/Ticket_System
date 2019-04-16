<?php
require_once('lib/ticket_class.php');
require_once('lib/config.php');
require_once('lib/common.php');

if (isset($_POST['add'])) {
    $column = [
        ':name_ticket' =>  filter_input(INPUT_POST, 'name_ticket', FILTER_SANITIZE_STRING),
        ':price' =>  filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT),
        ':image' =>  filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING),
        ':description' =>  filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)
    ];
    $addTicket = new Ticket();
    $addTicket->createTicket($column);
}
?>

<h3>Create a new ticket <button class="btn btn-primary" onclick="formToggle('new_ticket');">Form</button><br></h3>

<?php if (isset($_POST['add']) && $addTicket) { 
    echo $_POST['name_ticket']; ?> successfully added.<br>
<?php } ?><br>

<div id="new_ticket">
        <form method="post">
            <lable for="name_ticket">Ticket's name</lable>
            <input type="text" class="form-control" name="name_ticket" required>
            <lable for="price">Price</lable>
            <input type="number" step="any" min="1" class="form-control" name="price" required>
            <lable for="image">Image</lable>
            <input type="text" class="form-control" name="image" required><br>
            <lable for="image">Description</lable>
            <input type="text" class="form-control" name="description"><br>
            <button type="submit" class="btn btn-success" name="add"> Add new ticket</button>
        </form><br>
</div>