<?php
require_once '../src/config/db.php';

class AjouterAvis {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function ajouterAvis($pseudo, $avis) {
        $query = "INSERT INTO avis_attente (pseudo, texte_avis) VALUES (:pseudo, :texte_avis)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':texte_avis', $avis);
        return $stmt->execute();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = $_POST['pseudo'];
    $avis = $_POST['avis'];

    $ajouterAvis = new AjouterAvis();
    if ($ajouterAvis->ajouterAvis($pseudo, $avis)) {
        echo "Avis ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'avis.";
    }
}
?>
