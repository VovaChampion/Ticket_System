<?php

class Ticket 
{
    private $db;

    public function __construct() 
    {
        $this->db = new Db();
        $this->db = $this->db->connect();
    }

    // get all tickets
    public function getTickets() 
    {
        $stmt = $this->db->prepare('SELECT * FROM tickets');
        if($stmt->execute()){
            if($stmt->rowCount()>0){
                while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $data[] =$row;
                }
                return $data;
            }
        }
    }

    // create a new ticket
    public function createTicket($column)
    {
        $stmt = $this->db->prepare('INSERT INTO tickets
        (name_ticket, price, image, description) VALUES (:name_ticket, :price, :image, :description);');

        foreach($column as $key => $value) 
        {
            if($key == ':price')
            {
                $stmt->bindValue($key, $value, PDO::PARAM_INT);
            } else {
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            }
        }
        $stmt->execute();
    }

    // update the ticket
    public function updateTicket($column,$id)
    {
        try {
            $stmt = $this->db->prepare('UPDATE tickets 
            SET name_ticket = :name_ticket, price = :price, image = :image, description = :description 
            WHERE id = :id');
            foreach($column as $key => $value) 
            {
                if($key == ':price') 
                {
                    $stmt->bindValue($key,$value,PDO::PARAM_STR);
                } else 
                {
                    $stmt->bindValue($key,$value,PDO::PARAM_STR);
                }
            }
            $stmt->bindValue(':id',$id,PDO::PARAM_INT);

            if($stmt)
            {
                $stmt->execute();
                header('Location: index.php');
            }
        } catch (PDOException $e) {
            echo ($e->getMessage());
        }
    }
    // select the ticket
    public function selectTicket($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM tickets WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } 

    // delete the ticket
    public function removeTicket($id)
    {
        try
        {
            $stmt = $this->db->prepare('DELETE FROM tickets WHERE id = :id LIMIT 1');
            $result=$stmt->execute(['id'=>$id]);
            if($result)
            {
                header('Location: index.php');
            }
        } catch (PDOException $e)
        {
            echo ($e->getMessage());
        }
    } 

    // search ticket
    public function getSearchTicket($search) {
        $search = "%$search%";
        $sql = "SELECT * FROM tickets WHERE name_ticket LIKE :search OR 
                                            id LIKE :search OR
                                            price LIKE :search OR
                                            description LIKE :search";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':search' => $search]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } 
}

?>