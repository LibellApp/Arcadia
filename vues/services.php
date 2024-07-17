<?php
require_once '../controleurs/ServiceControleur.php';

$serviceControleur = new ServiceControleur();
$services = $serviceControleur->lireServices();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arcadia Zoo</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
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
        <section class="services">
            <h2>Services d'Arcadia</h2>
            <p>Chaque service à Arcadia est soigneusement conçu pour compléter votre visite en offrant confort, éducation et engagement envers la conservation de la nature. Nous sommes déterminés à créer des expériences inoubliables qui renforcent votre connexion avec la vie sauvage et la beauté de notre planète.</p>
            
            <div class="service-grille">
                <?php foreach ($services as $service) : ?>
                    <div class="service-item">
                        <img src="<?= htmlspecialchars($service['image']) ?>" alt="<?= htmlspecialchars($service['nom']) ?>">
                        <div class="service-text"><?= htmlspecialchars($service['nom']) ?></div>
                        <p><?= htmlspecialchars($service['description']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
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
