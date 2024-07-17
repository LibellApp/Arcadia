<?php
class RapportVeterinaire {
    private $conn;
    private $table_name = "rapports_veterinaires";

    public $id;
    public $animal_id;
    public $veterinaire_id;
    public $date_rapport;
    public $texte_rapport;
    public $nourriture;
    public $quantite_nourriture;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function creer() {
        $query = "INSERT INTO " . $this->table_name . " SET animal_id=:animal_id, veterinaire_id=:veterinaire_id, date_rapport=:date_rapport, texte_rapport=:texte_rapport, nourriture=:nourriture, quantite_nourriture=:quantite_nourriture";
        $stmt = $this->conn->prepare($query);

        $this->animal_id = htmlspecialchars(strip_tags($this->animal_id));
        $this->veterinaire_id = htmlspecialchars(strip_tags($this->veterinaire_id));
        $this->date_rapport = htmlspecialchars(strip_tags($this->date_rapport));
        $this->texte_rapport = htmlspecialchars(strip_tags($this->texte_rapport));
        $this->nourriture = htmlspecialchars(strip_tags($this->nourriture));
        $this->quantite_nourriture = htmlspecialchars(strip_tags($this->quantite_nourriture));

        $stmt->bindParam(":animal_id", $this->animal_id);
        $stmt->bindParam(":veterinaire_id", $this->veterinaire_id);
        $stmt->bindParam(":date_rapport", $this->date_rapport);
        $stmt->bindParam(":texte_rapport", $this->texte_rapport);
        $stmt->bindParam(":nourriture", $this->nourriture);
        $stmt->bindParam(":quantite_nourriture", $this->quantite_nourriture);

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
}
?>
