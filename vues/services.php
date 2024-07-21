<?php
session_start();
require_once '../src/config/db.php';

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    $query = "SELECT nom, description, horaires FROM services";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Arcadia Zoo</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
</head>
<body>
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
    <section class="services">
        <h2>Services d'Arcadia</h2>
        <p>Chaque service à Arcadia est soigneusement conçu pour compléter votre visite en offrant confort, éducation et engagement envers la conservation de la nature. Nous sommes déterminés à créer des expériences inoubliables qui renforcent votre connexion avec la vie sauvage et la beauté de notre planète.</p>
        
        <?php foreach ($services as $service): ?>
            <div class="service-item">
                <h3><?= htmlspecialchars($service['nom']); ?></h3>
                <?php if ($service['nom'] == 'Restaurant'): ?>
                    <img class="big" src="../src/images/WEBP/restaurant.webp" alt="Restauration">
                <?php elseif ($service['nom'] == 'Visite guidée gratuite'): ?>
                    <img src="../src/images/WEBP/visite_guidee_2.webp" alt="Visites Guidées">
                <?php elseif ($service['nom'] == 'Petit-train'): ?>
                    <img src="../src/images/WEBP/petit_train.webp" alt="Visites en petit train">
                <?php endif; ?>
                <p><?= nl2br(htmlspecialchars($service['description'])); ?></p>
                <p><strong>Horaires :</strong> <?= htmlspecialchars($service['horaires']); ?></p>
            </div>
        <?php endforeach; ?>
    </section>

    <footer>
        <div class="footer-content">
            <p>Parc Zoologique de Arcadia<br>
            42, rue Golden Order<br>
            35000 Lindell - France<br>
            tel : 02 ** ** ** **</p>
            <div class="footer-logo">
                <img src="../src/images/logo/EFC_Logo_Arcadia_B_Nom.svg" alt="Arcadia Zoo">
            </div>
        </div>
        <div class="footer-pdp">
            <p>&copy; 2024 Arcadia Zoo. Tous droits réservés.</p>
            <a href="#">Haut de page</a>
        </div>
    </footer>
</div>
</body>
</html>
