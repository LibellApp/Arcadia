<?php
class Commentaire {
    private $conn;
    private $table_name = "commentaires";

    public $id;
    public $nom_utilisateur;
    public $commentaire;
    public $valide;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function soumettre() {
        $query = "INSERT INTO " . $this->table_name . " SET nom_utilisateur=:nom_utilisateur, commentaire=:commentaire, valide=FALSE";
        $stmt = $this->conn->prepare($query);

        $this->nom_utilisateur = htmlspecialchars(strip_tags($this->nom_utilisateur));
        $this->commentaire = htmlspecialchars(strip_tags($this->commentaire));

        $stmt->bindParam(":nom_utilisateur", $this->nom_utilisateur);
        $stmt->bindParam(":commentaire", $this->commentaire);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function lireTous() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function valider() {
        $query = "UPDATE " . $this->table_name . " SET valide=TRUE WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
