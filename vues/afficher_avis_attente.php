<?php
session_start();
require_once '../src/config/db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Employé') {
    header("Location: ../controleurs/connexion.php");
    exit();
}

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();

    $query = "SELECT * FROM avis_attente";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $avisAttente = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher Avis en Attente</title>
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

    <section class="avis-attente">
        <h2>Liste des avis en attente</h2>
        <div class="avis-grille">
            <?php foreach ($avisAttente as $un_avis) : ?>
                <div class="avis-item">
                    <p><?= htmlspecialchars($un_avis['texte_avis']) ?></p>
                    <p><strong>- <?= htmlspecialchars($un_avis['pseudo']) ?></strong></p>
                    <a href="../controleurs/traiter_avis.php?id=<?= $un_avis['id'] ?>&action=accepter" class="btn-accept">✔</a>
                    <a href="../controleurs/traiter_avis.php?id=<?= $un_avis['id'] ?>&action=refuser" class="btn-decline">✖</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
