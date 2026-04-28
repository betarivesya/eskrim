<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "db_eskrim";
    public $conn;
    public function connect(): PDO {
        $this->conn = new PDO(
            "mysql:host=$this->host;dbname=$this->db",
            $this->user,
            $this->pass
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->conn;
    }
}
?>