<?php
session_start();
require_once '../src/config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $horaires = $_POST['horaires'];

        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();
            $query = "INSERT INTO services (nom, description, horaires) VALUES (:nom, :description, :horaires)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':horaires', $horaires);
            $stmt->execute();

            $_SESSION['message'] = "Service créé avec succès.";
        } catch (PDOException $e) {
            $_SESSION['message'] = "Erreur : " . $e->getMessage();
        }
    } elseif (isset($_POST['update'])) {
        $service_id = $_POST['service_id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $horaires = $_POST['horaires'];

        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();
            $query = "UPDATE services SET nom = :nom, description = :description, horaires = :horaires WHERE service_id = :service_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':horaires', $horaires);
            $stmt->bindParam(':service_id', $service_id);
            $stmt->execute();

            $_SESSION['message'] = "Service mis à jour avec succès.";
        } catch (PDOException $e) {
            $_SESSION['message'] = "Erreur : " . $e->getMessage();
        }
    } elseif (isset($_POST['delete'])) {
        $service_id = $_POST['service_id'];

        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();
            $query = "DELETE FROM services WHERE service_id = :service_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':service_id', $service_id);
            $stmt->execute();

            $_SESSION['message'] = "Service supprimé avec succès.";
        } catch (PDOException $e) {
            $_SESSION['message'] = "Erreur : " . $e->getMessage();
        }
    }
}

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    $query = "SELECT * FROM services";
    $stmt = $conn->query($query);
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['message'] = "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les Services</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
</head>
<body>
<header>
<header>
        <div class="header-content">
            <div class="logo">
                <img src="../src/images/logo/EFC_Logo_Arcadia_B_Nom.svg" alt="Arcadia Zoo">
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="habitats.php">Habitats</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="avis.php">Avis</a></li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="user-menu">
                        <span><?= htmlspecialchars($_SESSION['username']); ?></span>
                            <div class="separateur"></div>
                            <div class="menu-der">
                                <?php if ($_SESSION['role'] === 'Employé'): ?>
                                    <a href="afficher_avis_attente.php">Afficher Avis en Attente</a>
                                <?php endif; ?>
                                <?php if ($_SESSION['role'] === 'Administrateur'): ?>
                                    <a href="creation_compte.php">Créer un compte</a>
                                    <a href="modifier_services.php">Modifier les services</a>
                                    <a href="gerer_habitats_animaux.php">Gérer Habitats et Animaux</a>
                                <?php endif; ?>
                                <?php if ($_SESSION['role'] === 'Vétérinaire'): ?>
                                    <a href="suivi_veterinaire.php">Suivi Vétérinaire</a>
                                <?php endif; ?>
                                <a href="../controleurs/deconnexion.php">Se déconnecter</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li><a href="connexion.php">Connexion</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    
<div class="content">
    <h2>Modifier les Services</h2>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p>" . htmlspecialchars($_SESSION['message']) . "</p>";
        unset($_SESSION['message']);
    }
    ?>
    <!-- Formulaire pour créer un nouveau service -->
    <h3>Créer un nouveau service</h3>
    <form action="modifier_services.php" method="post">
        <input type="hidden" name="create" value="1">
        <div class="form-groupe">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div class="form-groupe">
            <label for="description">Description :</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div class="form-groupe">
            <label for="horaires">Horaires :</label>
            <textarea id="horaires" name="horaires" required></textarea>
        </div>
        <button type="submit" class="submit-btn">Créer le service</button>
    </form>

    <hr>

    <!-- Formulaire pour modifier ou supprimer des services existants -->
    <?php foreach ($services as $service): ?>
        <form action="modifier_services.php" method="post">
            <input type="hidden" name="service_id" value="<?= htmlspecialchars($service['service_id']) ?>">
            <div class="form-groupe">
                <label for="nom_<?= htmlspecialchars($service['service_id']) ?>">Nom :</label>
                <input type="text" id="nom_<?= htmlspecialchars($service['service_id']) ?>" name="nom" value="<?= htmlspecialchars($service['nom']) ?>" required>
            </div>
            <div class="form-groupe">
                <label for="description_<?= htmlspecialchars($service['service_id']) ?>">Description :</label>
                <textarea id="description_<?= htmlspecialchars($service['service_id']) ?>" name="description" required><?= htmlspecialchars($service['description']) ?></textarea>
            </div>
            <div class="form-groupe">
                <label for="horaires_<?= htmlspecialchars($service['service_id']) ?>">Horaires :</label>
                <textarea id="horaires_<?= htmlspecialchars($service['service_id']) ?>" name="horaires" required><?= htmlspecialchars($service['horaires']) ?></textarea>
            </div>
            <button type="submit" name="update" value="1" class="submit-btn">Mettre à jour</button>
            <button type="submit" name="delete" value="1" class="delete-btn">Supprimer</button>
        </form>
        <hr>
    <?php endforeach; ?>
</div>
</body>
</html>
