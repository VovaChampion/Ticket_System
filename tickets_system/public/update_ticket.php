<?php
require_once('lib/ticket_class.php');
require_once('lib/config.php');
require_once('lib/common.php');

if (isset($_GET['id'])) 
{
  $id = $_GET['id'];
  $ticket = new Ticket();
  $result = $ticket->selectTicket($id);
}
?>

<?php include "templates/header.php"; ?>

<h3>Update the ticket</h3><br>

<div class="container">
    <form action='' method="post">
        <input type='hidden' name='id' value='<?php echo escape($result['id']);?>'>
        <lable for="name_ticket">Ticket's name</lable>
        <input type="text" class="form-control" name="name_ticket" value="<?php echo escape($result['name_ticket']); ?>" required>
        <lable for="price">Price</lable>
        <input type="number" class="form-control" name="price" value="<?php echo escape($result['price']); ?>" required>
        <lable for="image">Image</lable>
        <input type="text" class="form-control" name="image" value="<?php echo escape($result['image']); ?>" required><br>
        <lable for="image">Description</lable>
        <input type="text" class="form-control" name="description" value="<?php echo escape($result['description']); ?>"><br>
        <button type="submit" class="btn btn-success" name="update" onclick="return confirmIt()"> Update the ticket</button>
    </form><br>
</div>

<?php

if(isset($_POST['update']))
{
  $column = [
    ':name_ticket' =>  filter_input(INPUT_POST, 'name_ticket', FILTER_SANITIZE_STRING),
    ':price' =>  filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT),
    ':image' =>  filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING),
    ':description' =>  filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)
  ];

  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT); 
  echo $id;

  $editTicket = new Ticket();
  $editTicket->updateTicket($column, $id);
}
?>

<a href="index.php" class="btn btn-primary" role="button">Go back to home page</a><br>

<?php include "templates/footer.php"; ?>

