<?php
require_once '../src/config/db.php';

class ImageControleur {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function lireImages() {
        $query = "SELECT i.image_path, h.nom as habitat_name FROM image i JOIN habitat h ON i.habitat_id = h.habitat_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
