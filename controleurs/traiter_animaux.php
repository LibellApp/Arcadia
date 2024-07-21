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
        $query = "INSERT INTO animal (prenom, race_id, habitat_id) VALUES (:prenom, :race_id, :habitat_id)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':prenom', $_POST['prenom']);
        $stmt->bindParam(':race_id', $_POST['race_id']);
        $stmt->bindParam(':habitat_id', $_POST['habitat_id']);
        $stmt->execute();
    } elseif ($_POST['action'] === 'update') {
        $query = "UPDATE animal SET prenom = :prenom, race_id = :race_id, habitat_id = :habitat_id WHERE animal_id = :animal_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':prenom', $_POST['prenom']);
        $stmt->bindParam(':race_id', $_POST['race_id']);
        $stmt->bindParam(':habitat_id', $_POST['habitat_id']);
        $stmt->bindParam(':animal_id', $_POST['animal_id']);
        $stmt->execute();
    } elseif ($_POST['action'] === 'delete') {
        $query = "DELETE FROM animal WHERE animal_id = :animal_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':animal_id', $_POST['animal_id']);
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
