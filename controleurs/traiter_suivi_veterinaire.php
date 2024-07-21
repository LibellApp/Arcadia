<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Vétérinaire') {
    header("Location: ../vues/connexion.php");
    exit();
}

require_once '../src/config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animal_id = $_POST['animal_id'];
    $etat = $_POST['etat'];
    $nourriture = $_POST['nourriture'];
    $grammage = $_POST['grammage'];
    $date_passage = $_POST['date_passage'];

    try {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $queryEtat = "SELECT etat_id FROM etat WHERE etat_label = :etat";
        $stmtEtat = $conn->prepare($queryEtat);
        $stmtEtat->bindParam(':etat', $etat);
        $stmtEtat->execute();
        $etat_id = $stmtEtat->fetchColumn();

        if (!$etat_id) {
            $insertEtat = "INSERT INTO etat (etat_label) VALUES (:etat)";
            $stmtInsertEtat = $conn->prepare($insertEtat);
            $stmtInsertEtat->bindParam(':etat', $etat);
            $stmtInsertEtat->execute();
            $etat_id = $conn->lastInsertId();
        }

        $query = "INSERT INTO rapport_veterinaire (animal_id, etat_id, nourriture, grammage, date) 
                    VALUES (:animal_id, :etat_id, :nourriture, :grammage, :date)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':animal_id', $animal_id);
        $stmt->bindParam(':etat_id', $etat_id);
        $stmt->bindParam(':nourriture', $nourriture);
        $stmt->bindParam(':grammage', $grammage);
        $stmt->bindParam(':date', $date_passage);
        $stmt->execute();

        $_SESSION['message'] = "Rapport vétérinaire enregistré avec succès.";
    } catch (PDOException $e) {
        $_SESSION['message'] = "Erreur : " . $e->getMessage();
    }

    header("Location: ../vues/suivi_veterinaire.php");
    exit();
} else {
    header("Location: ../vues/suivi_veterinaire.php");
    exit();
}
?>
