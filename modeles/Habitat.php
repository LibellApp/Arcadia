<?php
require_once '../config/db.php';

class Habitat {
    public $id;
    public $nom;
    public $description;
    public $image;

    public function lireTous() {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM habitat";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lireUn($id) {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM habitat WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
