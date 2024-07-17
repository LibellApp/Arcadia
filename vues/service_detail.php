<?php
require_once '../controleurs/ServiceControleur.php';

$serviceControleur = new ServiceControleur();
$service = $serviceControleur->lireService($_GET['id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $service['nom'] ?> - Arcadia Zoo</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">
                <img src="../css/images/SVG/EFC_Logo_Arcadia_B_Nom.svg" alt="Arcadia Zoo">
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="habitats.php">Habitats</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="avis.php">Avis</a></li>
                    <li><a href="connexion.php">Connexion</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="content">
        <h1><?= $service['nom'] ?></h1>
        <p><?= $service['description'] ?></p>
    </div>

    <footer>
        <div class="footer-content">
            <p>Parc Zoologique de Arcadia<br>
            42, rue Golden Order<br>
            35000 Lindell - France<br>
            tel : 02 ** ** ** **</p>
            <div class="footer-logo">
                <img src="../css/images/SVG/EFC_Logo_Arcadia_B_Nom.svg" alt="Arcadia Zoo">
            </div>
        </div>
        <div class="footer-pdp">
            <p>&copy; 2024 Arcadia Zoo. Tous droits réservés.</p>
            <a href="#">Haut de page</a>
        </div>
    </footer>
</body>
</html>
