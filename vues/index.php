<?php
session_start();
require_once '../controleurs/AvisControleur.php';

$avisControleur = new AvisControleur();
$avis = $avisControleur->lireAvis();
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
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>
        <section class="view">
            <div class="diapo">
                <button class="avant">&#9664;</button>
                <img class="big" src="../src/images/WEBP/escalier-bois.webp" alt="Hero Image">
                <div class="view-text">
                    <h1>Naturellement, tout simplement</h1>
                </div>
                <button class="apres">&#9654;</button>
            </div>
        </section>

        <section class="habitat">
            <h2>Habitat</h2>
            <div class="habitat-grille">
                <div class="habitat-item">
                    <a href="savane.php">
                        <img class="big" src="../src/images/habitats/enclot-savane-2.webp" alt="Savane">
                    </a>
                    <div class="habitat-text font">Savane</div>
                </div>
                <div class="habitat-item">
                    <a href="jungle.php">
                    <img src="../src/images/habitats/enclot-jungle.webp" alt="Jungle">
                    </a>
                    <div class="habitat-text">Jungle</div>
                </div>
                <div class="habitat-item">
                    <a href="aquarium.php">
                    <img src="../src/images/habitats/aquarium-2.webp" alt="Aquarium">
                    </a>
                    <div class="habitat-text">Aquarium</div>
                </div>
            </div>
        </section>

        <section class="services">
            <h2>Services</h2>
            <div class="services-grille">
                <div class="service-item">
                    <img src="../src/images/WEBP/restaurant.webp" alt="Restauration">
                    <div class="service-text">Restauration</div>
                </div>
                <div class="service-item">
                    <img src="../src/images/WEBP/visite_guidee_2.webp" alt="Visites Guidées">
                    <div class="service-text">Visites Guidées</div>
                </div>
                <div class="service-item">
                    <img src="../src/images/WEBP/petit_train.webp" alt="Visites en petit train">
                    <div class="service-text">Visites en petit train</div>
                </div>
            </div>
        </section>

        <section class="avis">
            <h2>Avis</h2>
            <div class="avis-grille">
            <?php foreach ($avis as $un_avis) : ?>
                <div class="avis-item">
                    <p><?= htmlspecialchars($un_avis['texte_avis']) ?></p>
                    <p><strong>- <?= htmlspecialchars($un_avis['pseudo']) ?></strong></p>
                </div>
            <?php endforeach; ?>
            </div>
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
