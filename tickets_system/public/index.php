<?php
require_once('lib/ticket_class.php');
require_once('lib/config.php');
require_once('lib/common.php');

$ticket = new Ticket();

if(isset($_GET['remove'])) {
	$id = $_GET['remove'];
	$ticket->removeTicket($id);
}

?>

<?php include "templates/header.php"; ?>

<div class="container">
	<?php include_once('create_ticket.php'); ?>

	<div class="search">
		<form method="post" class="example">
			<input type="text" name="search" placeholder="Search ...">
			<button type="submit" name="action"><i class="fa fa-search"></i></button>
		</form>

		<?php	
			$tickets = new Ticket();
			$list_tickets;

			if (isset($_POST['action'])) 
			{
				global $list_tickets, $tickets;
				
				$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_MAGIC_QUOTES);
				echo "You search for <strong>$search</strong><br>";
				$list_tickets = $tickets->getSearchTicket($search);
			} else {
				global $list_tickets, $tickets;
				$list_tickets = $tickets->getTickets();
			}
		?>
	</div>

	<h3>Tickets</h3><br>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Id</th>
					<th>Name</th>
					<th>Price</th>
					<th>Image</th>
					<th>Description</th>
					<th scope="col">Action</th>
				</tr>
			</thead>

			<tbody>
				<?php 
				$rows = $list_tickets;
				$i = 1;
				foreach ($rows as $row) { ?>
					<tr>
						<th scope="row"><?php echo escape($i) ?></th>
						<td><?php echo escape($row['id']); ?></td>
						<td><?php echo escape($row['name_ticket']); ?></td>
						<td><?php echo escape($row['price']); ?></td>
						<td><?php echo escape($row['image']); ?></td>
						<td><?php echo escape($row['description']); ?></td>
						<td>
							<a class="btn btn-sm btn-primary" href="update_ticket.php?id=<?php echo escape($row['id']); ?>">Update</a>
							<a class="btn btn-sm btn-danger" href="index.php?remove=<?php echo escape($row['id']); ?>"onclick="return confirmIt()">Remove</a>
						</td>
					</tr>
				<?php 
				$i++;
				}
				?>
			</tbody>
		</table>
</div>

<a href="product_page.php" class="btn btn-primary" role="button">Go to shop</a><br>
<a href="checkin.php" class="btn btn-primary" role="button">Go to Check In page</a><br>

<?php include "templates/footer.php"; ?>