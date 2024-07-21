<?php
require_once '../src/config/db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}

$db = Database::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $db->prepare("INSERT INTO avis (pseudo, texte_avis) SELECT pseudo, texte_avis FROM avis_attente WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $stmt = $db->prepare("DELETE FROM avis_attente WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo "Avis validé avec succès.";
    } else {
        echo "Une erreur s'est produite. Veuillez réessayer.";
    }
}

$stmt = $db->query("SELECT * FROM avis_attente");
$avis_attente = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitats - Arcadia Zoo</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
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
        <h2>Valider les avis des visiteurs</h2>
        <div class="avis-grille">
            <?php foreach ($avis_attente as $un_avis) : ?>
                <div class="avis-item">
                    <p><?= htmlspecialchars($un_avis['texte_avis']) ?></p>
                    <p><strong>- <?= htmlspecialchars($un_avis['pseudo']) ?></strong></p>
                    <form action="ValiderAvis.php" method="post">
                        <input type="hidden" name="id" value="<?= $un_avis['id'] ?>">
                        <button type="submit">Valider</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

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
</body>
</html>
