<?php
require_once "app/config/config.php";
//class connect to db
class DatabaseConnection
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn; //connection

    public function __construct()
    {
        $this->host = HOST;
        $this->db_name = DB_NAME;
        $this->username = USERNAME;
        $this->password = PASSWORD;
    }

    public function getConnection()
    {
        $this->conn = null;
        try { //try to connect to database
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) { //if error will show the message
            echo "Connection error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>