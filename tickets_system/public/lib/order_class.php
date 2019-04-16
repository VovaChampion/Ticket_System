<?php

class Order 
{
    private $db;

    public function __construct() 
    {
        $this->db = new Db();
        $this->db = $this->db->connect();
    }

    // select the order
    public function selectOrder($id)
    {
        $stmt = $this->db->prepare('SELECT o.id, oi.id, t.name_ticket, o.customer_name, oi.valid_date, oi.used_ticket FROM orders_items oi
        JOIN orders o ON o.id = oi.order_id
        JOIN tickets t ON t.id = oi.ticket_id
        WHERE o.id = :id');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    } 

    // get last order id (max)
    public function getLastOrderId()
    {
        $stmt = $this->db->prepare('SELECT MAX(id) FROM orders');
        $stmt->execute();

        $id = $stmt->fetchColumn();
        return $id;
    }

    // update tickets status YES
    public function updateTicketStatus($id_item)
    {
        $stmt = $this->db->prepare('UPDATE orders_items SET used_ticket = \'yes\' WHERE id = :id');
        $stmt->bindValue(':id',$id_item,PDO::PARAM_INT);
        $stmt->execute();
        echo "Thank you for using our site!";
        //header('Location: checkin.php');

    } 

    public function countDays($new_date)
    {
        $date = new DateTime ($new_date);
        $today = new DateTime (date("Y-m-d"));

        if($today > $date) {
            echo "The ticket is not valid";
        } elseif ($today == $date){
            echo "Today last day";
        } else {
            $days = $today->diff($date); 
            echo $days->format('%a days');
        }       
    }

    public function checkTicket($used,$new_date)
    {
        if($used === "no") {
            $date = new DateTime ($new_date);
            $today = new DateTime (date("Y-m-d"));
                if($today < $date) {
                    $days = $today->diff($date); 
                    echo $days->format('is valid for %a days.');
                } elseif ($today == $date){
                    echo "today is the last day to use your ticket.";
                } else {
                    echo "is already expired. Please, buy a new one.";
                }    
        } else {
            echo "has already been used. Please, buy a new one.";
        }

    }

    public function checkTicketUsed($used)
    {
        if($used === "no") {
            echo "Not nave been used yet";
        } else {
            echo "has already been used. Please, buy a new one.";
        }
    }

    public function selectOrderStatus($id_item)
    {
        $stmt = $this->db->prepare('SELECT oi.used_ticket FROM orders_items oi
        JOIN orders o ON o.id = oi.order_id
        JOIN tickets t ON t.id = oi.ticket_id
        WHERE oi.id = :id');

        $stmt->bindParam(':id', $id_item, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    } 

    public function createOrder($user_name,$user_email,$my_array)
    {
        $date = date('Y-m-d');
        $valid_date = date('Y-m-d', strtotime(' + 30 days'));

        $stmt = $this->db->prepare('INSERT INTO orders (customer_name, customer_email, order_date) 
        VALUES (:customer_name, :customer_email, :order_date);');

        $stmt->execute([
            ':customer_name' => $user_name, 
            ':customer_email' => $user_email, 
            ':order_date' => $date
        ]);
        
        $id_order = $this->db->lastInsertId(); 

        foreach($my_array as $key => $value)
        {
            $stmt = $this->db->prepare('INSERT INTO orders_items (order_id, ticket_id, valid_date, used_ticket) 
            VALUES (:order_id, :ticket_id, :valid_date, \'no\');');
            $stmt->execute([
				':order_id' => $id_order,
                ':ticket_id' => $value,
                ':valid_date' => $valid_date,
			]);
        }
        header("Location:confirm_order.php");
    }
}
?>
