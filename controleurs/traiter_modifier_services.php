<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Administrateur') {
    header("Location: ../vues/connexion.php");
    exit();
}
require_once '../src/config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $services = $_POST['services'];

    try {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        foreach ($services as $id => $service) {
            $query = "UPDATE services SET title = :title, description = :description WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':title', $service['title']);
            $stmt->bindParam(':description', $service['description']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        $_SESSION['message'] = "Services mis à jour avec succès.";
    } catch (PDOException $e) {
        $_SESSION['message'] = "Erreur : " . $e->getMessage();
    }
    header("Location: ../vues/modifier_services.php");
    exit();
} else {
    header("Location: ../vues/services.php");
    exit();
}
?>
