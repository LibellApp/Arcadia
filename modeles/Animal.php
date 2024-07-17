<?php
class Animal {
    private $conn;
    private $table_name = "animaux";

    public $id;
    public $nom;
    public $espece;
    public $habitat_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function creer() {
        $query = "INSERT INTO " . $this->table_name . " SET nom=:nom, espece=:espece, habitat_id=:habitat_id";
        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->espece = htmlspecialchars(strip_tags($this->espece));
        $this->habitat_id = htmlspecialchars(strip_tags($this->habitat_id));

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":espece", $this->espece);
        $stmt->bindParam(":habitat_id", $this->habitat_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function lire() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
