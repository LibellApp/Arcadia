<?php
require_once '../config/db.php';

class AvisControleur {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function lireAvis() {
        $query = "SELECT pseudo, texte_avis FROM avis WHERE valide = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
