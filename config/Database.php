<?php
// Database class to establish a connection to the MySQL database
class Database {
    private $host = 'localhost';        // Database host
    private $db_name = 'posts';    // Database name
    private $username = 'root';         // Database username
    private $password = '';             // Database password
    public $conn;

    // Method to get the database connection
    public function getConnection() {
        $this->conn = null;

        try {
            // Create a new PDO connection
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
