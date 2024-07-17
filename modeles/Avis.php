<?php
require_once '../config/db.php';

class Avis {
    public $id;
    public $pseudo;
    public $commentaire;
    public $valide;

    public function creer() {
        $db = Database::getInstance()->getConnection();
        $query = "INSERT INTO avis (pseudo, commentaire) VALUES (:pseudo, :commentaire)";
        $stmt = $db->prepare($query);

        $stmt->bindParam(":pseudo", $this->pseudo);
        $stmt->bindParam(":commentaire", $this->commentaire);

        return $stmt->execute();
    }

    public function lireTous() {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM avis WHERE valide = 1";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function validerAvis($id) {
        $db = Database::getInstance()->getConnection();
        $query = "UPDATE avis SET valide = 1 WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
