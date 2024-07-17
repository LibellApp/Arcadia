<?php
require_once '../config/db.php';

class Service {
    public $id;
    public $nom;
    public $description;

    public function lireTous() {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM service";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lireUn($id) {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM service WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
