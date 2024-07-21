<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Administrateur') {
    header("Location: ../vues/connexion.php");
    exit();
}

require_once '../src/config/db.php';

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();

    if ($_POST['action'] === 'create') {
        $query = "INSERT INTO habitat (nom, description) VALUES (:nom, :description)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nom', $_POST['nom']);
        $stmt->bindParam(':description', $_POST['description']);
        $stmt->execute();
    } elseif ($_POST['action'] === 'update') {
        $query = "UPDATE habitat SET nom = :nom, description = :description WHERE habitat_id = :habitat_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nom', $_POST['nom']);
        $stmt->bindParam(':description', $_POST['description']);
        $stmt->bindParam(':habitat_id', $_POST['habitat_id']);
        $stmt->execute();
    } elseif ($_POST['action'] === 'delete') {
        $query = "DELETE FROM habitat WHERE habitat_id = :habitat_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':habitat_id', $_POST['habitat_id']);
        $stmt->execute();
    }

    $_SESSION['message'] = "Opération réussie.";
    header("Location: ../vues/gerer_habitats_animaux.php");
    exit();
} catch (PDOException $e) {
    $_SESSION['message'] = "Erreur : " . $e->getMessage();
    header("Location: ../vues/gerer_habitats_animaux.php");
    exit();
}
?>
