<?php
class Db {
    
    // localhost
    private $host = 'localhost';
    private $db   = 'Tickets';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';

    // http://busticket.tmodel.se/
    // private $host = 'my71b.sqlserver.se';
    // private $db   = '236966-tickets';
    // private $user = '236966_fj33810';
    // private $pass = 'Maksym080713';
    // private $charset = 'utf8mb4';
    
    protected $conn;

    public function __construct() {
        try {
            $dsn = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
            $this->conn = new PDO($dsn, $this->user, $this->pass);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function connect(){
        return $this->conn;
    }
}