<?php
class Database {
    private static $instance = null;
    private $conn;

    private $host = 'localhost';
    private $dbName = 'arcadia_zoo';
    private $username = 'root'; // Remplacez par votre nom d'utilisateur MySQL
    private $password = ''; // Remplacez par votre mot de passe MySQL

    private function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
