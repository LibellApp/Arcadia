<?php
require_once '../controleurs/HabitatControleur.php';

$habitatControleur = new HabitatControleur();
$habitats = $habitatControleur->lireHabitats();
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
        <section class="habitat">
            <h2>Les différents habitats d'Arcadia</h2>
            <p>Bienvenue dans le majestueux espace zoologique d'Arcadia, où la nature et l'écologie se rencontrent pour offrir une expérience inoubliable.</p>
            <p>Chaque enclos et habitat est conçu pour reproduire au mieux l'environnement naturel de ses résidents, assurant leur bien-être et offrant aux visiteurs une immersion totale dans la beauté de la faune sauvage. Explorez et découvrez la diversité incroyable de notre monde animal dans le respect de la nature et de l'écologie.</p>
        </section>

        <section class="habitat">
            <h2>Les Habitats</h2>
            <div class="habitat-grille">
                <?php foreach ($habitats as $habitat) : ?>
                    <div class="habitat-item">
                        <img src="<?= htmlspecialchars($habitat['image']) ?>" alt="<?= htmlspecialchars($habitat['nom']) ?>">
                        <div class="habitat-text"><?= htmlspecialchars($habitat['nom']) ?></div>
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
