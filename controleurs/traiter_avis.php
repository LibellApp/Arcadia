<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../src/config/db.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    try {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        if ($action === 'accepter') {
            $query = "INSERT INTO avis (texte_avis, pseudo) SELECT texte_avis, pseudo FROM avis_attente WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $query = "DELETE FROM avis_attente WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } elseif ($action === 'refuser') {
            $query = "DELETE FROM avis_attente WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }

        header("Location: ../vues/afficher_avis_attente.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Paramètres manquants.";
}
?>
