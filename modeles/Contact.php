<?php
class Contact {
    private $conn;
    private $table_name = "contacts";

    public $id;
    public $titre;
    public $description;
    public $courriel;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function creer() {
        $query = "INSERT INTO " . $this->table_name . " SET titre=:titre, description=:description, courriel=:courriel";
        $stmt = $this->conn->prepare($query);

        $this->titre = htmlspecialchars(strip_tags($this->titre));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->courriel = htmlspecialchars(strip_tags($this->courriel));

        $stmt->bindParam(":titre", $this->titre);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":courriel", $this->courriel);

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
